<?php

namespace App\Core;

use Illuminate\Foundation\Http\FormRequest;


/**
 * Class Validates.php
 *
 * @package App\Core  *
 * @nickname <alphazet>
 * @author Otabek Davronbekov <davronbekov.otabek@gmail.com>
 *
 * Date: 28/10/2023
 */
abstract class Validates extends FormRequest
{
    public function __construct()
    {
        parent::__construct();
    }

    abstract public function authorize(): bool;
    abstract public function rules(): array;
}
