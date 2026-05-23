<?php

namespace App\Http\Controllers;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "ProviEmplea API",
    description: "API REST para gestión de talentos y empresas"
)]
#[OA\Server(
    url: "http://localhost:8080/api",
    description: "Servidor local"
)]
#[OA\Tag(name: "Health")]
#[OA\Tag(name: "Personas")]
#[OA\Tag(name: "Empresas")]
#[OA\Tag(name: "Administración")]
abstract class Controller
{
    //
}
