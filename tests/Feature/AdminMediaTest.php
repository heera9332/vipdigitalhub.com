<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Media;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminMediaTest extends TestCase
{
    use RefreshDatabase;

    private User $adminUser;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->adminUser = User::where('email', 'admin@vipdigitalhub.com')->first()
            ?? User::factory()->create([
                'email' => 'admin@vipdigitalhub.com',
                'password' => bcrypt('password'),
            ]);
    }

    public function test_guests_cannot_access_media_library(): void
    {
        $response = $this->get(route('admin.media.index'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_media_library(): void
    {
        $media = Media::factory()->create([
            'name' => 'Sample Hero Banner',
            'mime_type' => 'image/jpeg',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->get(route('admin.media.index'));

        $response->assertOk()
            ->assertSee('Media Library', false)
            ->assertSee('Sample Hero Banner', false);
    }

    public function test_admin_can_fetch_media_json_for_picker(): void
    {
        Media::factory()->create([
            'name' => 'Architecture Diagram',
            'file_name' => 'media/diagram.png',
            'mime_type' => 'image/png',
            'width' => 1200,
            'height' => 800,
            'size' => 102400,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->getJson(route('admin.media.index', ['format' => 'json']));

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'file_name',
                        'mime_type',
                        'size',
                        'url',
                        'is_image',
                        'human_size',
                    ],
                ],
                'current_page',
                'total',
            ]);

        $this->assertStringContainsString('Architecture Diagram', $response->getContent());
    }

    public function test_admin_can_search_media_json(): void
    {
        Media::factory()->create(['name' => 'Logo White']);
        Media::factory()->create(['name' => 'Mobile Mockup']);

        $response = $this->actingAs($this->adminUser)
            ->getJson(route('admin.media.index', ['format' => 'json', 'search' => 'Logo']));

        $response->assertOk();
        $data = $response->json('data');

        $this->assertCount(1, $data);
        $this->assertEquals('Logo White', $data[0]['name']);
    }

    public function test_admin_can_upload_media_via_ajax(): void
    {
        Storage::fake('public');

        // 1x1 PNG image binary (does not require PHP GD extension)
        $pngContent = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
        $file = UploadedFile::fake()->createWithContent('dashboard-preview.png', $pngContent);

        $response = $this->actingAs($this->adminUser)
            ->postJson(route('admin.media.store'), [
                'file' => $file,
                'name' => 'Dashboard Preview Hero',
                'alt_text' => 'Modern dark mode analytics dashboard',
            ]);

        $response->assertCreated()
            ->assertJsonPath('media.name', 'Dashboard Preview Hero')
            ->assertJsonPath('media.alt_text', 'Modern dark mode analytics dashboard')
            ->assertJsonPath('media.width', 1)
            ->assertJsonPath('media.height', 1);

        $this->assertDatabaseHas('media', [
            'name' => 'Dashboard Preview Hero',
            'mime_type' => 'image/png',
            'width' => 1,
            'height' => 1,
        ]);

        $media = Media::where('name', 'Dashboard Preview Hero')->first();
        $this->assertNotNull($media);
        Storage::disk('public')->assertExists($media->file_name);
    }

    public function test_admin_can_upload_media_via_standard_web_form(): void
    {
        Storage::fake('public');

        $file = UploadedFile::fake()->create('contract.pdf', 500, 'application/pdf');

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.media.store'), [
                'file' => $file,
                'name' => 'Client Project Contract',
            ]);

        $response->assertRedirect(route('admin.media.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('media', [
            'name' => 'Client Project Contract',
            'mime_type' => 'application/pdf',
        ]);
    }

    public function test_admin_can_update_media_metadata(): void
    {
        $media = Media::factory()->create([
            'name' => 'Old Title',
            'alt_text' => 'Old Alt',
        ]);

        $response = $this->actingAs($this->adminUser)
            ->put(route('admin.media.update', $media), [
                'name' => 'Refined Title',
                'alt_text' => 'Refined accessibility description',
            ]);

        $response->assertRedirect(route('admin.media.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('media', [
            'id' => $media->id,
            'name' => 'Refined Title',
            'alt_text' => 'Refined accessibility description',
        ]);
    }

    public function test_admin_can_delete_media_file(): void
    {
        Storage::fake('public');

        $path = 'media/test-delete-file.png';
        Storage::disk('public')->put($path, 'fake image content');

        $media = Media::factory()->create([
            'file_name' => $path,
        ]);

        $response = $this->actingAs($this->adminUser)
            ->delete(route('admin.media.destroy', $media));

        $response->assertRedirect(route('admin.media.index'))
            ->assertSessionHas('success');

        $this->assertDatabaseMissing('media', ['id' => $media->id]);
        Storage::disk('public')->assertMissing($path);
    }

    public function test_post_creation_accepts_featured_image_from_media_select(): void
    {
        $imageUrl = 'http://localhost/storage/media/sample-hero.jpg';

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.posts.store'), [
                'post_type' => 'post',
                'title' => 'Post with Media Selected Image',
                'category' => 'Engineering',
                'author' => 'Antigravity Team',
                'reading_time' => 5,
                'status' => 'published',
                'content' => '<p>Article with attached image</p>',
                'featured_image' => $imageUrl,
            ]);

        $response->assertRedirect(route('admin.posts.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Post with Media Selected Image',
            'featured_image' => $imageUrl,
            'post_type' => 'post',
        ]);
    }

    public function test_project_creation_accepts_featured_image_from_media_select(): void
    {
        $imageUrl = 'http://localhost/storage/media/project-thumbnail.webp';

        $response = $this->actingAs($this->adminUser)
            ->post(route('admin.projects.store'), [
                'title' => 'Enterprise Cloud Migration',
                'category' => 'DevOps & Cloud',
                'client' => 'FinTech Global',
                'year' => '2026',
                'short_description' => 'Migrated 50+ microservices to Kubernetes.',
                'description' => '<p>Detailed case study content...</p>',
                'technologies' => 'AWS, Kubernetes, Terraform',
                'status' => 'published',
                'featured_image' => $imageUrl,
            ]);

        $response->assertRedirect(route('admin.projects.index'));

        $this->assertDatabaseHas('posts', [
            'title' => 'Enterprise Cloud Migration',
            'featured_image' => $imageUrl,
            'post_type' => 'project',
        ]);
    }
}
