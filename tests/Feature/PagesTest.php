<?php

declare(strict_types=1);

namespace Tests\Feature;

use App\Models\Post;
use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PagesTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_home_page_is_accessible(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk()
            ->assertSee('VIP', false)
            ->assertSee('Digital Hub', false)
            ->assertSee('Start a Project');
    }

    public function test_services_page_is_accessible(): void
    {
        $response = $this->get(route('services'));

        $response->assertOk()
            ->assertSee('Web Development')
            ->assertSee('SaaS Development')
            ->assertSee('Custom Software Development');
    }

    public function test_about_page_is_accessible(): void
    {
        $response = $this->get(route('about'));

        $response->assertOk()
            ->assertSee('Our Mission')
            ->assertSee('Our Vision')
            ->assertSee('Battle-Tested Modern Stack');
    }

    public function test_projects_page_is_accessible(): void
    {
        $response = $this->get(route('projects'));

        $response->assertOk()
            ->assertSee('Case Studies')
            ->assertSee('All Work');
    }

    public function test_project_detail_page_is_accessible(): void
    {
        $project = Project::published()->first();
        $this->assertNotNull($project);

        $response = $this->get(route('projects.show', $project));

        $response->assertOk()
            ->assertSee($project->title)
            ->assertSee('Case Study');
    }

    public function test_posts_page_is_accessible(): void
    {
        $response = $this->get(route('posts.index'));

        $response->assertOk()
            ->assertSee('Knowledge Base')
            ->assertSee('Engineering Insights');
    }

    public function test_post_detail_page_is_accessible(): void
    {
        $post = Post::posts()->published()->first();
        $this->assertNotNull($post);

        $response = $this->get(route('posts.show', $post));

        $response->assertOk()
            ->assertSee($post->title)
            ->assertSee($post->author);
    }

    public function test_contact_page_is_accessible(): void
    {
        $response = $this->get(route('contact'));

        $response->assertOk()
            ->assertSee('Project Inquiry Form')
            ->assertSee('Work Email Address')
            ->assertSee('Send Project Inquiry');
    }

    public function test_contact_form_submission_success(): void
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'phone' => '+1 555 123 4567',
            'company' => 'Acme Corp',
            'service' => 'Web Development',
            'budget' => '$5,000 - $15,000',
            'message' => 'We need a full-featured web application built with Laravel and Tailwind CSS.',
            'website_url' => '', // Honeypot remains empty
        ];

        $response = $this->post(route('contact.submit'), $payload);

        $response->assertRedirect(route('contact'))
            ->assertSessionHas('success');

        $this->assertDatabaseHas('form_entries', [
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'form_name' => 'contact',
            'company' => 'Acme Corp',
            'service' => 'Web Development',
        ]);
    }

    public function test_contact_form_honeypot_spam_rejection(): void
    {
        $payload = [
            'name' => 'Bot Spammer',
            'email' => 'bot@spammer.com',
            'message' => 'Spam content buy links now.',
            'website_url' => 'https://spam.com', // Filled honeypot
        ];

        $response = $this->post(route('contact.submit'), $payload);

        $response->assertSessionHasErrors(['website_url']);
        $this->assertDatabaseMissing('form_entries', [
            'email' => 'bot@spammer.com',
        ]);
    }

    public function test_sitemap_xml_is_accessible(): void
    {
        $response = $this->get(route('sitemap'));

        $response->assertOk()
            ->assertHeader('Content-Type', 'application/xml');
    }

    public function test_projects_page_displays_featured_image_when_present(): void
    {
        $projectWithImage = Project::factory()->create([
            'status' => 'published',
            'published_at' => now()->subDay(),
            'category' => 'Showcase Category',
            'title' => 'Project With Custom Screenshot',
            'featured_image' => 'https://example.com/screenshot.png',
        ]);

        $projectWithoutImage = Project::factory()->create([
            'status' => 'published',
            'published_at' => now()->subDay(),
            'category' => 'Showcase Category',
            'title' => 'Project With Default Mockup',
            'featured_image' => null,
        ]);

        $response = $this->get(route('projects', ['category' => 'Showcase Category']));

        $response->assertOk()
            ->assertSee('https://example.com/screenshot.png')
            ->assertSee('Project With Custom Screenshot')
            ->assertSee('Project With Default Mockup');
    }
}
