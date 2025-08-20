<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certification;
use App\Models\Domain;
use App\Models\Topic;

class CertificationSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * PMP Certification
         */
        $pmp = Certification::updateOrCreate(
            ['slug' => 'pmp'],
            [
                'name' => 'Project Management Professional (PMP)',
                'duration' => 230,
                'is_active' => true,
                'description' => 'PMP is the gold standard of project management certification.'
            ]
        );

        $pmpDomains = [
            'People' => ['Leadership', 'Team Building', 'Conflict Resolution'],
            'Process' => ['Risk Management', 'Quality Management', 'Scheduling'],
            'Business Environment' => ['Compliance', 'Strategic Alignment']
        ];

        foreach ($pmpDomains as $domain => $topics) {
            $d = Domain::updateOrCreate(
                ['certification_id' => $pmp->id, 'name' => $domain],
                ['weight' => 30]
            );
            
            foreach ($topics as $topic) {
                Topic::updateOrCreate(
                    ['domain_id' => $d->id, 'name' => $topic]
                );
            }
        }

        /**
         * AWS Solutions Architect Certification
         */
        $aws = Certification::updateOrCreate(
            ['slug' => 'aws-sa'],
            [
                'name' => 'AWS Certified Solutions Architect – Associate',
                'duration' => 180,
                'is_active' => true,
                'description' => 'Validates cloud architecture knowledge for AWS.'
            ]
        );

        $awsDomains = [
            'Design Resilient Architectures' => ['High Availability', 'Disaster Recovery'],
            'Design High-Performing Architectures' => ['Scalability', 'Performance'],
            'Design Secure Applications' => ['IAM', 'Encryption'],
            'Design Cost-Optimized Architectures' => ['Cost Analysis', 'Resource Optimization']
        ];

        foreach ($awsDomains as $domain => $topics) {
            $d = Domain::updateOrCreate(
                ['certification_id' => $aws->id, 'name' => $domain],
                ['weight' => 25]
            );
            
            foreach ($topics as $topic) {
                Topic::updateOrCreate(
                    ['domain_id' => $d->id, 'name' => $topic]
                );
            }
        }

        /**
         * ITIL Foundation Certification
         */
        $itil = Certification::updateOrCreate(
            ['slug' => 'itil-foundation'],
            [
                'name' => 'ITIL 4 Foundation',
                'duration' => 60,
                'is_active' => true,
                'description' => 'Provides IT service management best practices.'
            ]
        );

        $itilDomains = [
            'Service Value System' => ['Guiding Principles', 'Governance'],
            'Service Value Chain' => ['Plan', 'Improve', 'Engage'],
            'Practices' => ['Incident Management', 'Change Enablement']
        ];

        foreach ($itilDomains as $domain => $topics) {
            $d = Domain::updateOrCreate(
                ['certification_id' => $itil->id, 'name' => $domain],
                ['weight' => 33]
            );
            
            foreach ($topics as $topic) {
                Topic::updateOrCreate(
                    ['domain_id' => $d->id, 'name' => $topic]
                );
            }
        }
    }
}