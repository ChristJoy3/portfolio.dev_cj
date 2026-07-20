<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\JourneyMilestone;
use App\Models\Project;
use App\Models\Skill;
use Illuminate\Database\Seeder;

/**
 * Ports the content that used to be hardcoded in welcome.blade.php into the database.
 * Idempotent: re-running updates rows in place rather than duplicating them.
 */
class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedAbout();
        $this->seedSkills();
        $this->seedProjects();
        $this->seedJourney();
    }

    private function seedAbout(): void
    {
        About::current()->update([
            'eyebrow' => 'About Me',
            'heading' => "Hi! I'm CJ",
            'lead' => 'A passionate Full-Stack Web Developer dedicated to building creative and innovative digital solutions.',
            'body' => implode("\n\n", [
                'I enjoy working with PHP, JavaScript, and MySQL to build responsive, user-friendly, and scalable web applications — from designing clean database schemas to crafting polished, interactive front-ends. I care about writing maintainable code and turning ideas into products people genuinely enjoy using.',
                "Based in the Philippines, I've built projects from scratch across a range of domains — personal projects, government-related systems, and school management systems — which taught me how to take a product from concept to deployment.",
            ]),
            'image_url' => 'assets/cjsheesh.png',
            'badge_text' => 'Based in the Philippines',
            'chips' => [
                ['label' => 'PHP', 'icon' => 'fa-brands fa-php'],
                ['label' => 'JavaScript', 'icon' => 'fa-brands fa-js'],
                ['label' => 'MySQL', 'icon' => 'fa-solid fa-database'],
                ['label' => 'Laravel', 'icon' => 'fa-brands fa-laravel'],
                ['label' => 'React', 'icon' => 'fa-brands fa-react'],
            ],
            'cta_label' => 'More About Me',
            'cta_url' => '/about',
        ]);
    }

    private function seedSkills(): void
    {
        $devicon = 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons';

        $skills = [
            ['name' => 'HTML', 'href' => 'https://developer.mozilla.org/docs/Web/HTML', 'accent' => '#e34f26', 'icon_url' => "$devicon/html5/html5-original.svg"],
            ['name' => 'CSS', 'href' => 'https://developer.mozilla.org/docs/Web/CSS', 'accent' => '#1572b6', 'icon_url' => "$devicon/css3/css3-original.svg"],
            ['name' => 'JavaScript', 'href' => 'https://developer.mozilla.org/docs/Web/JavaScript', 'accent' => '#f7df1e', 'icon_url' => "$devicon/javascript/javascript-original.svg"],
            ['name' => 'VS Code', 'href' => 'https://code.visualstudio.com', 'accent' => '#007acc', 'icon_url' => "$devicon/vscode/vscode-original.svg"],
            ['name' => 'Laravel', 'href' => 'https://laravel.com', 'accent' => '#ff2d20', 'icon_url' => "$devicon/laravel/laravel-original.svg"],
            // No devicon/simple-icons mark for Filament, so it keeps the Font Awesome bolt it
            // already used as a stand-in, tinted with its brand amber.
            ['name' => 'Filament', 'href' => 'https://filamentphp.com', 'accent' => '#fbbf24', 'icon_class' => 'fa-solid fa-bolt', 'icon_color' => '#fbbf24'],
            ['name' => 'Git', 'href' => 'https://git-scm.com', 'accent' => '#f05032', 'icon_url' => "$devicon/git/git-original.svg"],
            // icon_color intentionally null: the mark inherits the page colour so it stays visible
            // on both the dark and light themes.
            ['name' => 'GitHub', 'href' => 'https://github.com', 'accent' => '#c9d1d9', 'icon_class' => 'fa-brands fa-github'],
            ['name' => 'cPanel', 'href' => 'https://cpanel.net', 'accent' => '#ff6b35', 'icon_class' => 'fa-solid fa-server', 'icon_color' => '#ff6b35'],
            ['name' => 'MySQL', 'href' => 'https://www.mysql.com', 'accent' => '#4479a1', 'icon_url' => "$devicon/mysql/mysql-original.svg"],
            ['name' => 'PHP', 'href' => 'https://www.php.net', 'accent' => '#777bb4', 'icon_url' => "$devicon/php/php-original.svg"],
            ['name' => 'WordPress', 'href' => 'https://wordpress.org', 'accent' => '#21759b', 'icon_url' => "$devicon/wordpress/wordpress-plain.svg"],
        ];

        foreach ($skills as $i => $skill) {
            Skill::updateOrCreate(
                ['name' => $skill['name']],
                $skill + ['sort_order' => $i, 'is_active' => true]
            );
        }
    }

    private function seedProjects(): void
    {
        $projects = [
            // Portfolio Website has its real repo + live site. The rest use the GitHub profile and
            // live site as placeholders — replace with per-project links in the admin panel.
            [
                'title' => 'Portfolio Website',
                'image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&q=80',
                'description' => 'A personal portfolio built with modern web technologies showcasing projects and skills.',
                'tags' => ['HTML', 'TailwindCSS', 'JS'],
                'demo_url' => 'https://portfolio-dev-cj.vercel.app',
                'repo_url' => 'https://github.com/ChristJoy3/portfolio.dev_cj',
            ],
            [
                'title' => 'Admin Dashboard',
                'image_url' => 'https://images.unsplash.com/photo-1555066931-4365d14bab8c?w=600&q=80',
                'description' => 'A full-featured admin panel built with Laravel and Filament for content management.',
                'tags' => ['Laravel', 'Filament', 'MySQL'],
                'demo_url' => 'https://portfolio-dev-cj.vercel.app',
                'repo_url' => 'https://github.com/ChristJoy3',
            ],
            [
                'title' => 'E-Commerce Platform',
                'image_url' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?w=600&q=80',
                'description' => 'A responsive online store with cart functionality, payment integration, and order tracking.',
                'tags' => ['PHP', 'WordPress', 'MySQL'],
                'demo_url' => 'https://portfolio-dev-cj.vercel.app',
                'repo_url' => 'https://github.com/ChristJoy3',
            ],
            // Sample projects — edit or delete these in the admin panel. Themed to match the
            // domains named in the About section (school, government, local business systems).
            [
                'title' => 'School Management System',
                'image_url' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?w=600&q=80',
                'description' => 'Student records, enrollment workflows, and staff dashboards built for the day-to-day needs of teachers.',
                'tags' => ['Laravel', 'MySQL', 'Filament'],
                'demo_url' => 'https://portfolio-dev-cj.vercel.app',
                'repo_url' => 'https://github.com/ChristJoy3',
            ],
            [
                'title' => 'Government Records System',
                'image_url' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=600&q=80',
                'description' => 'A records and reporting system for a local government office, with role-based access and audit trails.',
                'tags' => ['PHP', 'MySQL', 'Bootstrap'],
                'demo_url' => 'https://portfolio-dev-cj.vercel.app',
                'repo_url' => 'https://github.com/ChristJoy3',
            ],
            [
                'title' => 'Restaurant Ordering App',
                'image_url' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=600&q=80',
                'description' => 'A table-side ordering and kitchen-queue app for a local restaurant, with a live order board.',
                'tags' => ['React', 'Node.js', 'Express'],
                'demo_url' => 'https://portfolio-dev-cj.vercel.app',
                'repo_url' => 'https://github.com/ChristJoy3',
            ],
        ];

        foreach ($projects as $i => $project) {
            Project::updateOrCreate(
                ['title' => $project['title']],
                $project + ['sort_order' => $i, 'is_active' => true]
            );
        }
    }

    private function seedJourney(): void
    {
        $milestones = [
            ['type' => 'experience', 'year' => '2021', 'title' => 'Started Learning Web Development', 'description' => 'Began self-learning HTML, CSS, and JavaScript through online resources and tutorials.'],
            ['type' => 'experience', 'year' => '2022', 'title' => 'First Freelance Project', 'description' => 'Completed my first client project — a WordPress website for a local business.'],
            ['type' => 'experience', 'year' => '2023', 'title' => 'Learned Laravel & PHP', 'description' => 'Dove into backend development with PHP and the Laravel framework, building full-stack applications.'],
            ['type' => 'experience', 'year' => '2024', 'title' => 'Expanded to Full-Stack', 'description' => 'Started building complete web applications using Laravel, Filament, and modern frontend tools.'],
            ['type' => 'experience', 'year' => '2025', 'title' => 'Building & Growing', 'description' => 'Continuing to ship projects, contribute to open source, and level up as a developer every day.'],

            // Placeholders — not real credentials. Edit these in the admin panel.
            ['type' => 'education', 'year' => '2014–2018', 'title' => 'Junior High School', 'description' => 'Sample National High School — placeholder entry, replace with your real school and details.'],
            ['type' => 'education', 'year' => '2018–2020', 'title' => 'Senior High School — STEM Strand', 'description' => 'Sample National High School — placeholder entry, replace with your real strand and details.'],
            ['type' => 'education', 'year' => '2020–2024', 'title' => 'BS in Information Technology', 'description' => 'Sample State University — placeholder entry, replace with your real university and capstone.'],
        ];

        foreach ($milestones as $i => $milestone) {
            JourneyMilestone::updateOrCreate(
                ['type' => $milestone['type'], 'title' => $milestone['title']],
                $milestone + ['sort_order' => $i, 'is_active' => true]
            );
        }
    }
}
