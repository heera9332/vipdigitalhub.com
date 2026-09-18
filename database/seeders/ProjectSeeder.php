<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [
            [
                'title' => 'AdminKit SaaS Template & Dashboard',
                'slug' => 'adminkit-saas-template-dashboard',
                'category' => 'SaaS Development',
                'client' => 'AdminKit.',
                'year' => '2025',
                'project_url' => '#stackconsole',
                'short_description' => 'A centralized multi-tenant cloud infrastructure and DevOps management platform simplifying Kubernetes deployments.',
                'description' => 'StackConsole needed a resilient multi-tenant SaaS application that allows engineering teams to monitor server health, deploy containerized workloads across AWS and DigitalOcean, and automate billing via Stripe. VIP Digital Hub designed and engineered the entire system using Laravel, high-throughput queue workers, real-time WebSocket telemetry, and Tailwind CSS.',
                'featured_image' => null,
                'technologies' => ['Laravel', 'Tailwind CSS', 'React.js', 'Redis', 'Docker', 'AWS'],
                'featured' => true,
                'status' => 'published',
                'sort_order' => 1,
                'published_at' => now()->subDays(30),
            ],
            [
                'title' => 'MedPulse Clinical Care & Telehealth Portal',
                'slug' => 'medpulse-clinical-portal',
                'category' => 'Custom Software',
                'client' => 'MedPulse Healthcare Systems',
                'year' => '2025',
                'project_url' => '#medpulse',
                'short_description' => 'Enterprise electronic health record (EHR) management and real-time video consultation platform for multi-specialty clinics.',
                'description' => 'VIP Digital Hub developed an end-to-end clinical workflow software suite connecting doctors, lab technicians, and patients. Features include end-to-end encrypted medical record storage, automated appointment scheduling, digital prescriptions, and WebRTC-based high-definition video consultations.',
                'featured_image' => null,
                'technologies' => ['Laravel', 'React', 'Tailwind CSS', 'MySQL', 'WebRTC'],
                'featured' => true,
                'status' => 'published',
                'sort_order' => 2,
                'published_at' => now()->subDays(25),
            ],
            [
                'title' => 'RetailMax High-Speed Omnichannel Store',
                'slug' => 'retailmax-omnichannel-store',
                'category' => 'Web Development',
                'client' => 'RetailMax Brands',
                'year' => '2024',
                'project_url' => '#retailmax',
                'short_description' => 'Sub-second page load e-commerce platform processing over 100,000 monthly orders with dynamic catalog synchronization.',
                'description' => 'Built for scale, RetailMax is a headless commerce implementation pairing a lightning-fast frontend with a robust backend inventory and order management system. It features instant faceted search, localized multi-currency pricing, and integration with third-party fulfillment warehouses.',
                'featured_image' => null,
                'technologies' => ['Next.js', 'Node.js', 'Tailwind CSS', 'Redis', 'Stripe'],
                'featured' => true,
                'status' => 'published',
                'sort_order' => 3,
                'published_at' => now()->subDays(20),
            ],
            [
                'title' => 'FleetFlow Real-time Telematics & Route Optimization',
                'slug' => 'fleetflow-telematics-system',
                'category' => 'Mobile App Development',
                'client' => 'FleetFlow Global Logistics',
                'year' => '2024',
                'project_url' => '#fleetflow',
                'short_description' => 'GPS-enabled fleet tracking, dynamic route dispatching, and driver performance telemetry app for commercial fleets.',
                'description' => 'FleetFlow replaced manual paper logs with an automated mobile dispatch app and live web dashboard. We designed the architecture to handle second-by-second telemetry ingestion, geofencing event alerts, and fuel efficiency optimization algorithms.',
                'featured_image' => null,
                'technologies' => ['Flutter', 'Laravel', 'Google Maps API', 'WebSockets', 'MySQL'],
                'featured' => false,
                'status' => 'published',
                'sort_order' => 4,
                'published_at' => now()->subDays(15),
            ],
            [
                'title' => 'FinScale Wealth Analytics & Portfolio Dashboard',
                'slug' => 'finscale-portfolio-analytics',
                'category' => 'Custom Software',
                'client' => 'FinScale Capital Advisory',
                'year' => '2024',
                'project_url' => '#finscale',
                'short_description' => 'Institutional investment reporting tool with live market feeds, risk stress-testing, and automated client compliance reports.',
                'description' => 'VIP Digital Hub engineered an interactive analytics dashboard allowing private wealth advisors to model portfolio performance under various macroeconomic scenarios, track dividend yields, and export branded PDF compliance packages in seconds.',
                'featured_image' => null,
                'technologies' => ['Laravel', 'React', 'Tailwind CSS', 'Chart.js', 'PostgreSQL'],
                'featured' => false,
                'status' => 'published',
                'sort_order' => 5,
                'published_at' => now()->subDays(10),
            ],
            [
                'title' => 'UrbanNest Commercial Property MLS & CRM',
                'slug' => 'urbannest-property-crm',
                'category' => 'Web Development',
                'client' => 'UrbanNest Realty Group',
                'year' => '2024',
                'project_url' => '#urbannest',
                'short_description' => 'Next-generation commercial real estate directory with 3D virtual tour embeds, lead routing, and lease contract tracking.',
                'description' => 'An all-in-one web portal and internal CRM built to streamline property listings, automated buyer qualification, broker commissions, and digital document signing for a nationwide commercial brokerage.',
                'featured_image' => null,
                'technologies' => ['Laravel', 'Alpine.js', 'Tailwind CSS', 'MySQL', 'Algolia'],
                'featured' => false,
                'status' => 'published',
                'sort_order' => 6,
                'published_at' => now()->subDays(5),
            ],
        ];

        foreach ($projects as $data) {
            Project::updateOrCreate(
                ['slug' => $data['slug']],
                $data
            );
        }
    }
}
