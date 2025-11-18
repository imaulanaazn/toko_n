<?php

namespace App\Controllers;

use App\Models\BahanProdukModel;
use App\Models\PengeluaranModel;
use App\Models\PenjualanModel;
use App\Models\PenjualanProdukModel;
use App\Models\ProdukModel;
use App\Models\PromoModel;
use App\Models\TrxPengeluaranModel;
use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var list<string>
     */
    protected $helpers = [];

    protected $userModel;
    protected $session;
    protected $pengeluaranModel;
    protected $trxPengeluaranModel;
    protected $produkModel;
    protected $bahanProdukModel;
    protected $promoModel;
    protected $penjualanModel;
    protected $penjualanProdukModel;
    protected $validation;
    protected $role;




    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->session = session();
        $this->userModel = new UserModel();
        $this->pengeluaranModel = new PengeluaranModel();
        $this->trxPengeluaranModel = new TrxPengeluaranModel();
        $this->produkModel = new ProdukModel();
        $this->bahanProdukModel = new BahanProdukModel();
        $this->promoModel = new PromoModel();
        $this->penjualanModel = new PenjualanModel();
        $this->penjualanProdukModel = new PenjualanProdukModel();
        $this->validation = \Config\Services::validation();
        $this->role = session()->get('role');

        // E.g.: $this->session = service('session');
    }
}
