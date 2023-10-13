<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\QuoteRequest;

class ManagerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer("*", function($view) {
            if (Auth::check())
            {
                if (Auth::user()->role == 3) {
                    $view->with("quotesCarrierCount",
                            DB::table("quote_comps")
                                ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
                                ->select(
                                    "quote_comps.*",
                                    "quote_requests.*"
                                )
                                ->where("carrier_id", Auth::user()->id)
                                ->where("status", ">=", 6)
                                ->where("status", "<=", 12)
                                ->count()
                    );
                    $view->with("quotesSubmittedCarrierCount",
                            DB::table("quote_comps")
                                ->where("carrier_id", Auth::user()->id)
                                ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
                                ->select(
                                    "quote_comps.*",
                                    "quote_requests.*"
                                )
                                ->where("status", 6)
                                ->count()
                    );
                    $view->with("quotesPublishedCarrierCount",
                        DB::table("quote_comps")
                            ->where("carrier_id", Auth::user()->id)
                            ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
                            ->select(
                                "quote_comps.*",
                                "quote_requests.*"
                            )
                            ->where("status", ">=", 7)
                            ->where("status", "<", 12)
                            ->count()
                    );
                    $view->with("quotesCompletedCarrierCount",
                            DB::table("quote_comps")
                                ->where("carrier_id", Auth::user()->id)
                                ->join("quote_requests", "quote_comps.quote_id", "=", "quote_requests.id")
                                ->select(
                                    "quote_comps.*",
                                    "quote_requests.*"
                                )
                                ->where("status", 12)
                                ->count()
                    );
                } else if (Auth::user()->role == 2){
                    $view->with("myQuotes", QuoteRequest::where("status", ">", 1)->where("customer_id", Auth::user()->id)->get());
                };
            }
        });
    }
}
