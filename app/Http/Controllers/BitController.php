<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use app\Library\HD;
use BitWasp\Bitcoin\Bitcoin;
use BitWasp\Bitcoin\Address;
use BitWasp\Bitcoin\Key\Factory\PrivateKeyFactory;

class BitController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index(Request $request)
    {


$network = Bitcoin::getNetwork();
$child = 0;
$xpub = 'xpub661MyMwAqRbcGYcu6n1FmV1TbE8EwnSKecRZLvKAMyj4qLf15qXsoNryiKNvCkRq3z5kBCeZG8115jj28eVqmeKBJZPqjAfwRD3TGx1w5hY';
$hk = HierarchicalKeyFactory::fromExtended($xpub,$network);
$address = $hk->deriveChild($child)->getPublicKey()->getAddress();
echo $address->getAddress();

    }


    
}

