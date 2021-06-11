<?php

use App\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['intiwid', 'agfa', 'bayer', 'careray', 'clear', 'iradimed'];
        $categories = ['RIS & PACS', 'Modality & Film', 'Modality & BHP', 'DR', 'Printer & Dry Film', 'Modality'];
        $origins = ['Indonesia', 'Mortsel, Belgia', 'Leverkusen, Jerman', 'Jiangsu, China', 'China', 'US'];
        $descriptions = [
            '  PACS is a system created and developed by PT. INTIMEDIKA PUSPA INDAH, Domestic products,
        which include RIS Features with Unlimited User License, Unlimited modality connectivity,
        Unlimited procedures per Annum that can be run on a Multi Operating System (OS).',

            'The Agfa-Gevaert Group develops, produces and distributes an extensive range of analog and digital imaging systems and IT solutions, mainly for the printing industry and the healthcare sector, as well as for specific industrial applications.',
            'Bayer is a Life Science company with a more than 150-year history and core competencies in the areas of health care and agriculture. With our innovative products, we are contributing to finding solutions to some of the major challenges of our time.',

            'CareRay is a global company dedicated to the innovative development of digital X-ray flat panel detectors. We are wholly committed to engineering excellence, world-class R&D, and the highest manufacturing standards. From system upgrades to custom OEM solutions, we offer sophisticated products for diagnostic imaging in all fields.',

            ' Clear was founded in 2008. It is the facilitator of the leading medical self-service system and intelligent medical health solutions.  CLEAR’s business covers B2C medical data cloud web, intelligent self-service terminal, medical information and external printing contracts. With its data covering the whole department, CLEAR has been focusing on the development from electronic healthcare record to mobile medical ecosystem.',

            'At IRadimed, we work hard every day to provide you with the best possible products and services while pushing the boundaries of technical innovation. Since founding Invivo Research Inc, the predecessor to Invivo Corporation in the early 1980s and now founding IRadimed in 2004, I have lived through the MRI market’s transformation.'

        ];
        $contact = 'sales@intimedika.co';

        $i = 0;
        $j = 0;
        foreach ($titles as $title) {
            // DB::transaction(function () use ($title, $categories, $contact, $descriptions, $origins, $i, $j) {
            $products = Product::create([
                'slug' => Str::slug($title . $categories[$i]),
                'title' => $title,
                'category' => $categories[$i],
                'origin' => $origins[$i],
                'product' => $title,
                'contact' => $contact,
                'description' => $descriptions[$i],
            ]);

            if ($title == 'iradimed') {
                $j = 2;
            } elseif ($title == 'agfa' || $title == 'bayer') {
                $j = 7;
            } else {
                $j = 3;
            }

            for ($k = 1; $k <= $j; $k++) {
                // dd('assets/img/product/' . $title . '-' . $k);
                $products
                    ->addMedia(public_path('assets/img/product/' . $title . '-' . $k . '.png'))
                    ->preservingOriginal()
                    ->toMediaCollection($title);
            }
            $i++;
            // });
        }
    }
}
