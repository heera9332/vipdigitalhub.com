<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\FormEntry;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminTest extends TestCase
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

    public function test_guests_are_redirected_to_admin_login(): void
    {
        $response = $this->get(route('admin.dashboard'));

        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk()
            ->assertSee('Admin Sign In', false)
            ->assertSee('VIP Digital Hub', false);
    }

    public function test_admin_can_authenticate_with_valid_credentials(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@vipdigitalhub.com',
            'password' => 'password',
        ]);

        $this->assertAuthenticatedAs($this->adminUser);
        $response->assertRedirect(route('admin.dashboard'));
    }

    public function test_admin_cannot_authenticate_with_invalid_credentials(): void
    {
        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@vipdigitalhub.com',
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
        $response->assertSessionHasErrors('email');
    }

    public function test_admin_can_logout(): void
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.logout'));

        $this->assertGuest();
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_dashboard_displays_key_agency_metrics(): void
    {
        $response = $this->actingAs($this->adminUser)->get(route('admin.dashboard'));

        $response->assertOk()
            ->assertSee('Executive Dashboard')
            ->assertSee('Project Inquiries')
            ->assertSee('Knowledge Base')
            ->assertSee('Client Work');
    }

    public function test_admin_can_create_post_with_tiptap_rich_text(): void
    {
        $tiptapHtml = '<h2>High Throughput Systems</h2><p>Here is an article drafted using the <strong>TipTap editor</strong> with rich HTML content.</p><ul><li>Zero downtime</li><li>Horizontal scaling</li></ul>';

        $response = $this->actingAs($this->adminUser)->post(route('admin.posts.store'), [
            'title' => 'Building High-Throughput APIs with Laravel 12',
            'slug' => 'building-high-throughput-apis-laravel-12',
            'category' => 'Architecture',
            'author' => 'VIP Engineering Team',
            'status' => 'published',
            'excerpt' => 'An architectural walkthrough of scaling APIs.',
            'content' => $tiptapHtml,
        ]);

        $response->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', [
            'slug' => 'building-high-throughput-apis-laravel-12',
            'status' => 'published',
            'author' => 'VIP Engineering Team',
        ]);

        $post = Post::where('slug', 'building-high-throughput-apis-laravel-12')->first();
        $this->assertNotNull($post);
        $this->assertStringContainsString('TipTap editor', $post->content);
        $this->assertGreaterThanOrEqual(1, $post->reading_time);

        // Verify frontend renders the TipTap rich HTML inside prose container
        $frontendResponse = $this->get(route('posts.show', $post));
        $frontendResponse->assertOk()
            ->assertSee('High Throughput Systems', false)
            ->assertSee('TipTap editor', false);
    }

    public function test_admin_can_update_and_delete_post(): void
    {
        $post = Post::factory()->create([
            'title' => 'Original Post Title',
            'slug' => 'original-post-title',
            'status' => 'draft',
        ]);

        $updateResponse = $this->actingAs($this->adminUser)->put(route('admin.posts.update', $post), [
            'title' => 'Updated Post Title via Admin',
            'slug' => 'updated-post-title-via-admin',
            'category' => 'Cloud & DevOps',
            'author' => 'Lead Architect',
            'status' => 'published',
            'content' => '<p>Updated content body in TipTap.</p>',
        ]);

        $updateResponse->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Post Title via Admin',
            'category' => 'Cloud & DevOps',
        ]);

        $post->refresh();

        $deleteResponse = $this->actingAs($this->adminUser)->delete(route('admin.posts.destroy', $post));
        $deleteResponse->assertRedirect(route('admin.posts.index'));
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }

    public function test_admin_can_manage_case_study_projects(): void
    {
        // 1. Index & Create screens
        $this->actingAs($this->adminUser)->get(route('admin.projects.index'))->assertOk()->assertSee('Portfolio & Case Studies', false);
        $this->actingAs($this->adminUser)->get(route('admin.projects.create'))->assertOk()->assertSee('New Case Study');

        // 2. Store
        $createResponse = $this->actingAs($this->adminUser)->post(route('admin.projects.store'), [
            'title' => 'Global Logistics Automation Platform',
            'slug' => 'global-logistics-automation-platform',
            'category' => 'Custom Software',
            'client' => 'FreightCorp',
            'year' => '2026',
            'short_description' => 'Automated cross-border shipping management.',
            'description' => 'Full architectural specification of the logistics engine.',
            'technologies' => 'Laravel, Vue, AWS, Docker',
            'status' => 'published',
            'featured' => 1,
            'sort_order' => 5,
        ]);

        $createResponse->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('posts', [
            'post_type' => 'project',
            'slug' => 'global-logistics-automation-platform',
            'client' => 'FreightCorp',
            'featured' => true,
        ]);

        $project = Project::where('slug', 'global-logistics-automation-platform')->first();
        $this->assertNotNull($project);
        $this->assertIsArray($project->technologies);
        $this->assertContains('Laravel', $project->technologies);

        // Verify project is visible on public projects list & detail page
        $this->get(route('projects'))->assertOk()->assertSee('Global Logistics Automation Platform');
        $this->get(route('projects.show', $project))->assertOk()->assertSee('FreightCorp');

        // 3. Edit & Update
        $this->actingAs($this->adminUser)->get(route('admin.projects.edit', $project))->assertOk();
        $updateResponse = $this->actingAs($this->adminUser)->put(route('admin.projects.update', $project), [
            'title' => 'Updated Global Logistics Automation',
            'slug' => 'global-logistics-automation-platform',
            'category' => 'Custom Software',
            'client' => 'FreightCorp International',
            'year' => '2026',
            'short_description' => 'Updated short description.',
            'description' => 'Updated description body.',
            'technologies' => 'Laravel, Redis, AWS',
            'status' => 'published',
            'featured' => 0,
            'sort_order' => 2,
        ]);
        $updateResponse->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('posts', [
            'id' => $project->id,
            'title' => 'Updated Global Logistics Automation',
            'client' => 'FreightCorp International',
        ]);

        // 4. Delete project
        $deleteResponse = $this->actingAs($this->adminUser)->delete(route('admin.projects.destroy', $project));
        $deleteResponse->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseMissing('posts', ['id' => $project->id]);
    }

    public function test_admin_can_review_and_update_inquiry_status(): void
    {
        $inquiry = FormEntry::create([
            'form_name' => 'contact',
            'name' => 'Michael Chang',
            'email' => 'michael@techstartup.io',
            'phone' => '+1 415 555 2671',
            'company' => 'TechStartup Inc',
            'service' => 'SaaS Development',
            'budget' => '$15,000 - $50,000',
            'message' => 'We need an enterprise multi-tenant system built on Laravel.',
            'status' => 'new',
            'ip_address' => '127.0.0.1',
        ]);

        $viewResponse = $this->actingAs($this->adminUser)->get(route('admin.forms.entries.show', $inquiry));
        $viewResponse->assertOk()
            ->assertSee('Michael Chang')
            ->assertSee('michael@techstartup.io')
            ->assertSee('enterprise multi-tenant system');

        $statusResponse = $this->actingAs($this->adminUser)->patch(route('admin.forms.entries.status', $inquiry), [
            'status' => 'in_progress',
        ]);

        $statusResponse->assertRedirect();
        $this->assertDatabaseHas('form_entries', [
            'id' => $inquiry->id,
            'status' => 'in_progress',
        ]);
    }

    public function test_admin_can_update_site_settings(): void
    {
        $response = $this->actingAs($this->adminUser)->post(route('admin.settings.update'), [
            'settings' => [
                'site_name' => 'VIP Digital Hub Enterprise',
                'site_email' => 'contact@vipdigitalhub.com',
                'site_phone' => '+91 7000153244',
            ],
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('site_settings', [
            'key' => 'site_name',
            'value' => 'VIP Digital Hub Enterprise',
        ]);

        $this->assertSame('VIP Digital Hub Enterprise', setting('site_name'));
    }

    public function test_admin_can_manage_services(): void
    {
        // 1. Index
        $indexResponse = $this->actingAs($this->adminUser)->get(route('admin.services.index'));
        $indexResponse->assertOk()
            ->assertSee('Services & Offerings', false)
            ->assertSee('Add Service');

        // 2. Create form
        $createFormResponse = $this->actingAs($this->adminUser)->get(route('admin.services.create'));
        $createFormResponse->assertOk()
            ->assertSee('New Service');

        // 3. Store new service
        $storeResponse = $this->actingAs($this->adminUser)->post(route('admin.services.store'), [
            'title' => 'DevOps & Cloud Automation',
            'slug' => 'devops-cloud-automation',
            'short_description' => 'Automated CI/CD pipelines and multi-cloud orchestration on AWS and GCP.',
            'description' => 'Full architectural specification for enterprise Kubernetes, Terraform infrastructure, and automated rollback workflows.',
            'category' => 'Cloud & Infrastructure',
            'icon' => 'cloud',
            'features' => 'Docker Orchestration, Terraform IaC, Zero-Downtime Deployments',
            'cta' => 'Scale Cloud Infrastructure',
            'status' => 'published',
            'sort_order' => 3,
        ]);

        $storeResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('posts', [
            'post_type' => 'service',
            'slug' => 'devops-cloud-automation',
            'title' => 'DevOps & Cloud Automation',
            'icon' => 'cloud',
            'status' => 'published',
        ]);

        $service = Service::where('slug', 'devops-cloud-automation')->first();
        $this->assertNotNull($service);
        $this->assertIsArray($service->features);
        $this->assertContains('Docker Orchestration', $service->features);

        // Verify service shows on frontend services page
        $frontendResponse = $this->get(route('services'));
        $frontendResponse->assertOk()
            ->assertSee('DevOps & Cloud Automation')
            ->assertSee('Automated CI/CD pipelines');

        // 4. Edit form
        $editResponse = $this->actingAs($this->adminUser)->get(route('admin.services.edit', $service));
        $editResponse->assertOk()
            ->assertSee('Edit: DevOps & Cloud Automation');

        // 5. Update
        $updateResponse = $this->actingAs($this->adminUser)->put(route('admin.services.update', $service), [
            'title' => 'Updated Cloud & DevOps Engineering',
            'slug' => 'devops-cloud-automation',
            'short_description' => 'Updated short description for cloud automation.',
            'description' => 'Updated content body.',
            'icon' => 'cpu',
            'features' => 'Terraform, Ansible, Kubernetes',
            'cta' => 'Deploy Now',
            'status' => 'published',
            'sort_order' => 1,
        ]);

        $updateResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('posts', [
            'id' => $service->id,
            'title' => 'Updated Cloud & DevOps Engineering',
            'icon' => 'cpu',
        ]);

        // 6. Delete
        $deleteResponse = $this->actingAs($this->adminUser)->delete(route('admin.services.destroy', $service));
        $deleteResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('posts', ['id' => $service->id]);
    }
}
