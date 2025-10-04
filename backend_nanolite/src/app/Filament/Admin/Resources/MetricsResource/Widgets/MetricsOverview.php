<?php

namespace App\Filament\Admin\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

use App\Models\User;
use App\Models\Order;
use App\Models\Garansi;
use App\Models\ProductReturn;
use App\Models\Customer;

class MetricsOverview extends BaseWidget
{
    protected static ?int $sort = 10;

    protected function getCards(): array
    {
        // ambil hanya data dengan status 'pending'
        $pendingOrders = Order::where('status_order', 'pending')->count();
        $pendingGaransi = Garansi::where('status_garansi', 'pending')->count();
        $pendingReturn = ProductReturn::where('status_return', 'pending')->count();
        $pendingCustomer = Customer::where('status', 'pending')->count();


        return [

            Card::make('Order Pending', $pendingOrders)
                ->description('Pengajuan order menunggu konfirmasi')
                ->icon('heroicon-o-shopping-bag')
                ->color('primary'),

            Card::make('Garansi Pending', $pendingGaransi)
                ->description('Pengajuan garansi belum diproses')
                ->icon('heroicon-o-shield-check')
                ->color('warning'),

            Card::make('Return Pending', $pendingReturn)
                ->description('Pengajuan return belum disetujui')
                ->icon('heroicon-o-arrow-uturn-left')
                ->color('danger'),

            Card::make('Customers', $pendingCustomer)
                ->description('Pengajuan customer menunggu disetujui')
                ->icon('heroicon-o-user')
                ->color('info'),
        ];
    }
}
