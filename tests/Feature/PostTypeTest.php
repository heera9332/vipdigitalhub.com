<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Enums\PostType;
use App\Models\Post;
use App\Models\Project;
use App\Models\Service;
use Database\Seeders\PostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTypeTest extends TestCase
{
    use RefreshDatabase;

    public function test_post_schema_defaults_to_post_type_post(): void
    {
        $post = Post::create([
            'title' => 'Default Post Type Check',
            'slug' => 'default-post-type-check',
            'category' => 'Technology',
            'author' => 'Tester',
            'content' => '<p>Checking default post_type.</p>',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertSame(PostType::Post->value, $post->post_type);
        $this->assertTrue($post->isPost());
        $this->assertFalse($post->isProject());
        $this->assertFalse($post->isService());

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'post_type' => 'post',
        ]);
    }

    public function test_project_post_type_can_be_created_and_queried(): void
    {
        $project = Project::create([
            'title' => 'Fintech Cloud Platform',
            'slug' => 'fintech-cloud-platform',
            'category' => 'Fintech',
            'client' => 'Apex Financial',
            'year' => '2026',
            'short_description' => 'Real-time ledger processing engine.',
            'description' => 'Detailed architecture of high-speed banking ledgers.',
            'technologies' => ['Laravel', 'Redis', 'Tailwind CSS'],
            'project_url' => 'https://example.com/fintech',
            'featured' => true,
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertSame(PostType::Project->value, $project->post_type);
        $this->assertTrue($project->isProject());
        $this->assertSame('Real-time ledger processing engine.', $project->short_description);
        $this->assertSame('Real-time ledger processing engine.', $project->excerpt);
        $this->assertSame('Detailed architecture of high-speed banking ledgers.', $project->description);
        $this->assertSame('Detailed architecture of high-speed banking ledgers.', $project->content);
        $this->assertContains('Redis', $project->technologies);

        $this->assertDatabaseHas('posts', [
            'slug' => 'fintech-cloud-platform',
            'post_type' => 'project',
            'client' => 'Apex Financial',
            'featured' => true,
        ]);

        $found = Post::projects()->where('slug', 'fintech-cloud-platform')->first();
        $this->assertNotNull($found);
        $this->assertSame($project->id, $found->id);
    }

    public function test_service_post_type_can_be_created_and_queried(): void
    {
        $service = Service::create([
            'title' => 'AI & Machine Learning Engineering',
            'slug' => 'ai-ml-engineering',
            'excerpt' => 'Custom predictive algorithms and LLM integrations.',
            'content' => 'Full-stack AI workflows from model fine-tuning to production APIs.',
            'icon' => 'cpu',
            'features' => ['Model Fine-Tuning', 'Vector Databases', 'RAG Pipelines'],
            'cta' => 'Scale with AI',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertSame(PostType::Service->value, $service->post_type);
        $this->assertTrue($service->isService());
        $this->assertSame('cpu', $service->icon);
        $this->assertContains('Vector Databases', $service->features);
        $this->assertSame('Scale with AI', $service->cta);

        $this->assertDatabaseHas('posts', [
            'slug' => 'ai-ml-engineering',
            'post_type' => 'service',
            'icon' => 'cpu',
            'cta' => 'Scale with AI',
        ]);

        $found = Post::services()->where('slug', 'ai-ml-engineering')->first();
        $this->assertNotNull($found);
        $this->assertSame($service->id, $found->id);
    }

    public function test_services_page_renders_dynamically_from_database(): void
    {
        Service::create([
            'title' => 'Custom Blockchain Protocols',
            'slug' => 'custom-blockchain-protocols',
            'excerpt' => 'High-throughput private ledger engineering.',
            'content' => 'Enterprise security and smart contract development.',
            'icon' => 'layers',
            'features' => ['Smart Contracts', 'Layer 2 Rollups'],
            'cta' => 'Explore Blockchain',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $response = $this->get(route('services'));

        $response->assertOk()
            ->assertSee('Custom Blockchain Protocols')
            ->assertSee('High-throughput private ledger engineering.')
            ->assertSee('Smart Contracts')
            ->assertSee('Explore Blockchain');
    }

    public function test_post_type_scopes_isolate_content_types(): void
    {
        Post::create([
            'title' => 'Standard Blog Post 1',
            'slug' => 'standard-blog-post-1',
            'post_type' => PostType::Post->value,
            'content' => 'Blog content',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Post::create([
            'title' => 'Project Alpha',
            'slug' => 'project-alpha',
            'post_type' => PostType::Project->value,
            'content' => 'Project details',
            'status' => 'published',
            'published_at' => now(),
        ]);

        Post::create([
            'title' => 'Consulting Service',
            'slug' => 'consulting-service',
            'post_type' => PostType::Service->value,
            'content' => 'Consulting details',
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertSame(1, Post::posts()->count());
        $this->assertSame('Standard Blog Post 1', Post::posts()->first()->title);

        $this->assertSame(1, Post::projects()->count());
        $this->assertSame('Project Alpha', Post::projects()->first()->title);

        $this->assertSame(1, Post::services()->count());
        $this->assertSame('Consulting Service', Post::services()->first()->title);
    }

    public function test_seeders_seed_all_post_types(): void
    {
        $this->seed(PostSeeder::class);

        $this->assertGreaterThanOrEqual(1, Post::posts()->count());
        $this->assertGreaterThanOrEqual(1, Post::projects()->count());
        $this->assertGreaterThanOrEqual(1, Post::services()->count());
    }
}
