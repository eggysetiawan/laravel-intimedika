<?php

use App\Invoice;
use App\User;
use App\Offer;
use App\SalesPenawaran;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class OfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sales_penawaran = SalesPenawaran::whereNotNull('pk_cust_penawaran')->get();

        foreach ($sales_penawaran as $penawaran) {

            $username = 1;
            if (User::where('username', $penawaran->username)->first()) {
                $username = User::where('username', $penawaran->username)->first()->id;
            }

            $approved_by = User::where('id', 2)->first()->id;

            $has_form_note = 1;
            $form_note = $penawaran->ket_form;

            if (!$penawaran->ket_form || $penawaran->ket_form == '') {
                $has_form_note = null;
                $form_note = null;
            }

            switch ($penawaran->approve) {
                case 'approved':
                    $approval = 1;
                    break;
                case 'revisi':
                    $approval = 3;
                    break;

                case 'revisi':
                    $approval = 3;
                    break;
                case 'rejected':
                    $approval = 2;
                    break;

                default:
                    $approval = null;
                    break;
            }

            if ($penawaran->approve != 'approved') {
                $penawaran->approvecreated_at = null;
                $penawaran->approved_by = null;
                $approved_by = null;
            }

            $offers = Offer::create([
                'id' => $penawaran->pk_penawran,
                'customer_id' => $penawaran->pk_cust_penawaran,
                'user_id' => $username,
                'offer_no' => $penawaran->no_penawaran,
                'slug' => Str::slug(str_replace('/', '-', $penawaran->no_penawaran)),
                'budget' => $penawaran->budget_penawaran,
                'offer_date' => date('Y-m-d', strtotime($penawaran->tgl_penawaran)),
                'price_note' => $penawaran->pen_harga,
                'warranty_note' => $penawaran->pen_garansi,
                'availability_note' => $penawaran->pen_ketersediaan,
                'payment_note' => $penawaran->pen_keterangan,
                'has_form_note' => $has_form_note,
                'form_note' => $form_note,
                'is_approved' => $approval,
                'approved_at' => $penawaran->approvecreated_at,
                'approved_by' => $approved_by,
                'created_at' => $penawaran->tgl_penawaran,
                'updated_at' => $penawaran->tgl_penawaran,
            ]);

            $offers->invoices()->create([
                'offer_id' => $offers->id,
                'date' => $penawaran->tgl_penawaran,
                'status' => 'old',
            ]);
        }
    }
}
