<?php

use App\User;
use App\Offer;
use App\Order;
use App\Invoice;
use App\FirstOffer;
use App\OrderChart;
use App\SalesOrder;
use App\SalesFunnel;
use App\SalesTarget;
use App\FixPriceOrder;
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

                $username = User::where('username', 'intiwid01')->first();
                if (User::where('username', $penawaran->username)->first()) {
                    $username = User::where('username', $penawaran->username)->first();
                }

                $approved_by = User::where('id', 2)->first()->id;

                $has_form_note = 1;
                $form_note = $penawaran->ket_form;

                if (!$penawaran->ket_form || $penawaran->ket_form == '') {
                    $has_form_note = null;
                    $form_note = null;
                }

                // switch ($penawaran->approve) {
                //     case 'approved':
                //         $approval = 1;
                //         break;
                //     case 'revisi':
                //         $approval = 3;
                //         break;
                //     case 'rejected':
                //         $approval = 2;
                //         break;

                //     default:
                //         $approval = null;
                //         break;
                // }

                // if ($penawaran->approve != 'approved') {
                //     $penawaran->approvecreated_at = null;
                //     $penawaran->approved_by = null;
                //     $approved_by = null;
                // }

                // if ($penawaran->approve != 'approved') {
                $penawaran->approvecreated_at = date('Y-m-d', strtotime('+1 day'));
                // }

                $offers = Offer::create([
                    'id' => $penawaran->pk_penawran,
                    'customer_id' => $penawaran->pk_cust_penawaran,
                    'user_id' => $username->id,
                    'offer_no' => $penawaran->no_penawaran,
                    'offer_no_unique' =>  date('Y', strtotime($penawaran->tgl_penawaran)) . substr($penawaran->no_penawaran, 3, 3),
                    'slug' => Str::slug(str_replace('/', '-', $penawaran->no_penawaran)),
                    'budget' => $penawaran->budget_penawaran,
                    'offer_date' => date('Y-m-d', strtotime($penawaran->tgl_penawaran)),
                    'price_note' => $penawaran->pen_harga,
                    'warranty_note' => $penawaran->pen_garansi,
                    'availability_note' => $penawaran->pen_ketersediaan,
                    'payment_note' => $penawaran->pen_keterangan,
                    'has_form_note' => $has_form_note,
                    'form_note' => $form_note,
                    'is_approved' => 1,
                    'approved_at' => $penawaran->approvecreated_at,
                    'approved_by' => $approved_by,
                    'created_at' => $penawaran->tgl_penawaran,
                    'updated_at' => $penawaran->tgl_penawaran,
                ]);


                $sales_funnel = SalesFunnel::query()
                    ->with('sales_targeting')
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
                    $progress = str_replace("%", "", $sales_funnel->buy_funnel);
                    if ($sales_funnel->approve2 != 'approved') {
                        $approved_at = null;
                        $approved_by = null;
                    }

                    if ($sales_funnel->approve2 != 'approved' && str_replace("%", "", $sales_funnel->buy_funnel) == 100) {
                        $progress = 99;
                    }

                    $offers->progress()->create([
                        'id' => $sales_funnel->pk,
                        'offer_id' => $sales_funnel->penawaran_fk,
                        'progress' => $progress,
                        'detail' => $sales_funnel->status2_funnel,
                        'status' => $sales_funnel->status_funnel,
                        'progress_date' => $sales_funnel->start_funnel->format('Y-m-d'),
                        'is_approved' => $approval,
                        'approved_at' => $approved_at,
                        'approved_by' => $approved_by,
                        'created_at' => $sales_funnel->start_funnel,
                        'updated_at' => $sales_funnel->start_funnel
                    ]);

                    $invoice_no = null;
                    $invoice_date = null;

                    if ($sales_funnel->sales_targeting) {
                        $invoice_no = $sales_funnel->sales_targeting->noInvoice_targeting ?? null;
                        $invoice_date = $sales_funnel->sales_targeting->tgl_invoice_targeting ?? null;
                    }

                    $invoices = $offers->invoices()->create([
                        'offer_id' => $offers->id,
                        'date' => $invoice_date ?? $penawaran->tgl_penawaran->format('Y-m-d'),
                        'invoice_no' => $invoice_no,
                        'status' => 'old',
                    ]);

                    foreach ($penawaran->sales_order as $order) {
                        if ($order->fk_penawaran && $order->pk_mod_order) {

                            Order::insert([
                                'id' => $order->pk_order,
                                'invoice_id' => $invoices->id,
                                'modality_id' => $order->pk_mod_order,
                                'price' => str_replace(",", ".", $order->harga_order),
                                'quantity' => $order->qty_order,
                                'references' => $order->sales_penawaran->referensi_penawaran,
                                'is_order' => 1,
                                'created_at' => $order->sales_penawaran->tgl_penawaran,
                                'updated_at' => $order->sales_penawaran->tgl_penawaran,
                            ]);

                            FirstOffer::insert([
                                'offer_id' => $invoices->offer->id,
                                'order_id' => $order->pk_order,
                                'quantity' => $order->qty_order,
                                'price' => str_replace(",", ".", $order->harga_order),
                            ]);



                            $order_id = null;
                            $fixPrice = null;
                            if ($sales_funnel->harga_po) {
                                $order_id = $order->pk_order;
                                $fixPrice = str_replace(",", ".", $order->harga_order);
                            }
                            FixPriceOrder::insert([
                                'order_id' => $order_id,
                                'offer_id' => $invoices->offer->id,
                                'modality_id' => $order->pk_mod_order,
                                'price' => $fixPrice,
                                'created_at' => $order->sales_penawaran->tgl_penawaran,
                                'updated_at' => $order->sales_penawaran->tgl_penawaran,
                            ]);
                        }
                    }

                    if ($sales_funnel->gambar) {
                        $invoices
                            ->addMedia(storage_path('MigrasiPdf/' . $sales_funnel->gambar))
                            ->preservingOriginal()
                            ->toMediaCollection('image_po');
                    }


                    // if ($sales_funnel->sales_targeting) {
                    //     if ($sales_funnel->sales_targeting->gambarPO_targeting) {
                    //         $invoices
                    //             ->addMedia(storage_path('MigrasiPdf/' . $sales_funnel->gambar))
                    //             ->preservingOriginal()
                    //             ->toMediaCollection('image_po');
                    //     }
                    // }





                    if ($sales_funnel->harga_po) {
                        $ppn = $sales_funnel->harga_po * (10 / 100);
                        $invoices->tax()->create([
                            'offer_id' => $offers->id,
                            'is_paid' => 0,
                            'price_po' => $sales_funnel->harga_po + $ppn,
                            'dpp' => $sales_funnel->harga_po,
                            'ppn' => $ppn,
                            'nett' => $sales_funnel->harga_po,
                        ]);
                    }


                    if ($sales_funnel->approve2) {
                        $invoices->chart()->create([
                            'user_id' => $username->id,
                            'sales_name' => $username->name,
                            'price' => $sales_funnel->harga_po,
                            'is_approved' => $approval,
                            'offer_date' => date('Y-m-d', strtotime($penawaran->tgl_penawaran)),
                            'invoice_date' => date('Y-m-d', strtotime($invoice_date ?? $penawaran->tgl_penawaran)),
                            'year' => date('Y', strtotime($penawaran->tgl_penawaran)),
                        ]);
                    }
                }
            }); //DB::transaction
        }
    }
}
