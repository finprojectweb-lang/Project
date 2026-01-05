<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DiscoverController extends Controller
{
    /**
     * Display the Our Values page
     *
     * @return \Illuminate\View\View
     */
    public function ourValues()
    {
        $values = [
            [
                'title' => 'Keberlanjutan',
                'icon' => '🌱',
                'class' => 'sustainability',
                'description' => 'Kami berkomitmen untuk menciptakan solusi jangka panjang yang tidak hanya mengurangi jejak karbon, tetapi juga membangun ekosistem yang sehat dan berkelanjutan untuk generasi mendatang.'
            ],
            [
                'title' => 'Inovasi',
                'icon' => '💡',
                'class' => 'innovation',
                'description' => 'Terus berinovasi dalam teknologi kompensasi karbon dan metode pengukuran dampak lingkungan untuk memberikan solusi paling efektif dan efisien kepada klien kami.'
            ],
            [
                'title' => 'Integritas',
                'icon' => '🤝',
                'class' => 'integrity',
                'description' => 'Menjalankan bisnis dengan standar etika tertinggi, memastikan setiap kredit karbon yang kami tawarkan terverifikasi dan berdampak nyata terhadap lingkungan.'
            ],
            [
                'title' => 'Kolaborasi',
                'icon' => '🤲',
                'class' => 'collaboration',
                'description' => 'Bekerja sama dengan komunitas lokal, organisasi internasional, dan para pemangku kepentingan untuk menciptakan dampak positif yang lebih besar terhadap planet kita.'
            ],
            [
                'title' => 'Transparansi',
                'icon' => '🔍',
                'class' => 'transparency',
                'description' => 'Menyediakan data dan laporan yang jelas tentang proyek-proyek kami, memastikan klien dapat melacak kontribusi mereka dan dampak nyata yang tercipta.'
            ],
            [
                'title' => 'Dampak Nyata',
                'icon' => '🌍',
                'class' => 'impact',
                'description' => 'Fokus pada hasil yang terukur dan berkelanjutan, memastikan setiap aksi yang kami lakukan memberikan kontribusi signifikan dalam memerangi perubahan iklim global.'
            ]
        ];

        $statistics = [
            ['number' => 500, 'label' => 'Proyek Aktif'],
            ['number' => 1000000, 'label' => 'Ton CO₂ Offset'],
            ['number' => 50, 'label' => 'Negara Partner'],
            ['number' => 10000, 'label' => 'Hektar Hutan']
        ];

        return view('our-values', compact('values', 'statistics'));
    }

    /**
     * Display other discover pages if needed
     */
    public function about()
    {
        return view('about');
    }

    public function ourTeam()
    {
        return view('our-team');
    }

    public function ourMission()
    {
        return view('our-mission');
    }
}