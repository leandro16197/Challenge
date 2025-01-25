<?php
namespace App\Http\Controllers;

use App\Models\LifePurchaseOption;
use App\Models\Pagos;
use Illuminate\Http\Request;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MercadoPagoController extends Controller
{
    public function createPreference(Request $request)
    { 
        MercadoPagoConfig::setAccessToken(env('MERCADO_PAGO_ACCESS_TOKEN'));
        $validated = $request->validate([
                'vidaId' => 'required|integer',
            
        ]);

        $id = $request->input('vidaId'); 
        $dato=LifePurchaseOption::select('price')->where('id',$id)->first();
        
        $client = new PreferenceClient();
        $preference = $client->create([
            "items" => [
                [
                    "title" => "Vidas Quiz",
                    "quantity" => 1,
                    "unit_price" => $dato->price, 
                ]
            ],
            "back_urls" => [
                "success" => route('success', ['vidaId' => $request->input('vidaId')]),
                "failure" => route('failure'),
                "pending" => route('pending'),
            ],
            "auto_return" => "approved",
        ]);    
        $user = Auth::user();

        $pago = Pagos::create([
            'user_id' => $user->id,
            'life_purchase_option_id' => $id,  
            'amount' => $dato->price, 
            'payment_status' => 'Pago',  
            'payment_method' => 'mercadopago',  
            'preference_id'  => $preference->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        
        return response()->json([
            "preferenceId" => $preference->id,
        ]);
    }    
}


