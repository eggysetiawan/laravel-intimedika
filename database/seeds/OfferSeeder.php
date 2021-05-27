<?php

use App\User;
use App\Offer;
use App\Invoice;
use App\SalesFunnel;
use App\SalesPenawaran;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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
            DB::transaction(function () use ($penawaran) {

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
                $sales_funnel = SalesFunnel::query()
                    ->whereNotNull('penawaran_fk')
                    ->where('penawaran_fk', $penawaran->pk_penawaran)
                    ->first();

                if ($sales_funnel->penawaran_fk) {

                    switch ($sales_funnel->approve2) {
                        case 'approved':
                            $approval = 1;

                            break;

                        case 'rejected':
                            $approval = 2;
                            break;

                        default:
                            $approval = null;
                            break;
                    }

                    $approved_at = $sales_funnel->start_funnel->addDays(1);
                    if ($sales_funnel->approve2 != 'approved') {
                        $approved_at = null;
                        $approved_by = null;
                    }


                    $offers->progress()->create([
                        'id' => $sales_funnel->pk,
                        'offer_id' => $sales_funnel->penawaran_fk,
                        'progress' => str_replace("%", "", $sales_funnel->buy_funnel),
                        'detail' => $sales_funnel->status2_funnel,
                        'status' => $sales_funnel->status_funnel,
                        'progress_date' => $sales_funnel->start_funnel->format('Y-m-d'),
                        'is_approved' => $approval,
                        'approved_at' => $approved_at,
                        'approved_by' => $approved_by,
                        'created_at' => $sales_funnel->start_funnel,
                        'updated_at' => $sales_funnel->start_funnel
                    ]);
                }
            });
        }
    }
}
