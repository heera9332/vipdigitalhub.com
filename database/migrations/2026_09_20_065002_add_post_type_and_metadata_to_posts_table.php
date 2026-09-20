<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('post_type', 50)->default('post')->after('id')->index();
            $table->longText('content')->nullable()->change();
            $table->string('client')->nullable()->after('category');
            $table->string('year', 10)->nullable()->after('client');
            $table->string('project_url')->nullable()->after('year');
            $table->json('technologies')->nullable()->after('project_url');
            $table->json('gallery')->nullable()->after('technologies');
            $table->boolean('featured')->default(false)->index()->after('gallery');
            $table->integer('sort_order')->default(0)->index()->after('featured');
            $table->string('icon')->nullable()->after('sort_order');
            $table->json('features')->nullable()->after('icon');
            $table->string('cta')->nullable()->after('features');
        });

        if (Schema::hasTable('projects')) {
            $existingProjects = DB::table('projects')->get();
            foreach ($existingProjects as $project) {
                if (! DB::table('posts')->where('slug', $project->slug)->exists()) {
                    DB::table('posts')->insert([
                        'post_type' => 'project',
                        'title' => $project->title,
                        'slug' => $project->slug,
                        'excerpt' => $project->short_description,
                        'content' => $project->description ?? '',
                        'featured_image' => $project->featured_image,
                        'gallery' => $project->gallery,
                        'technologies' => $project->technologies,
                        'category' => $project->category,
                        'author' => 'VIP Digital Hub',
                        'reading_time' => 5,
                        'client' => $project->client,
                        'year' => $project->year,
                        'project_url' => $project->project_url,
                        'featured' => $project->featured,
                        'sort_order' => $project->sort_order,
                        'status' => $project->status,
                        'published_at' => $project->published_at,
                        'created_at' => $project->created_at,
                        'updated_at' => $project->updated_at,
                    ]);
                }
            }

            Schema::dropIfExists('projects');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasTable('projects')) {
            Schema::create('projects', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->text('short_description');
                $table->longText('description')->nullable();
                $table->string('featured_image')->nullable();
                $table->json('gallery')->nullable();
                $table->json('technologies')->nullable();
                $table->string('category')->index();
                $table->string('project_url')->nullable();
                $table->string('client')->nullable();
                $table->string('year', 10)->nullable();
                $table->boolean('featured')->default(false)->index();
                $table->string('status', 20)->default('published')->index();
                $table->integer('sort_order')->default(0)->index();
                $table->timestamp('published_at')->nullable()->index();
                $table->timestamps();
            });
        }

        Schema::table('posts', function (Blueprint $table) {
            $table->dropIndex(['post_type']);
            $table->dropIndex(['featured']);
            $table->dropIndex(['sort_order']);
            $table->dropColumn([
                'post_type',
                'client',
                'year',
                'project_url',
                'technologies',
                'gallery',
                'featured',
                'sort_order',
                'icon',
                'features',
                'cta',
            ]);
        });
    }
};
