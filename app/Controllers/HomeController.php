<?php

namespace App\Controllers;

use App\Database\Filters;
use App\Database\Models\User;
use App\Database\Pagination;

class HomeController extends Controller
{
    public function index()
    {
        $filters = new Filters();
        //$filters->where('id', '>', 1);

        $pagination = new Pagination();
        $pagination->setItemsPerPage(1);

        $user = new User();
        $user->setFields('id, firstname, lastname');
        $user->setFilters($filters);
        $user->setPagination($pagination);
        $usersFound = $user->fetchAll();

        return $this->view('home', [
            'title' => 'home',
            'usersFound' => $usersFound,
            'pagination' => $pagination,
        ]);
    }
}
