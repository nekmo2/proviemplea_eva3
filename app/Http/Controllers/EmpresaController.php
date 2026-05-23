<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use OpenApi\Attributes as OA;

class EmpresaController extends Controller
{
    #[OA\Get(
        path: "/empresas",
        tags: ["Empresas"],
        summary: "Listar empresas",
        description: "Obtiene todas las empresas registradas",
        responses: [
            new OA\Response(
                response: 200,
                description: "Listado de empresas"
            )
        ]
    )]
    public function index()
    {
        return response()->json(Empresa::all());
    }

    #[OA\Get(
        path: "/empresas/{id}",
        tags: ["Empresas"],
        summary: "Obtener empresa por ID",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Empresa encontrada"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrada"
            )
        ]
    )]
    public function show(Empresa $empresa)
    {
        return response()->json($empresa);
    }

    #[OA\Post(
        path: "/empresas",
        tags: ["Empresas"],
        summary: "Crear empresa",
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                required: ["nombre_empresa", "rut_empresa", "email"],
                properties: [
                    new OA\Property(property: "nombre_empresa", type: "string", example: "Tech Chile"),
                    new OA\Property(property: "rut_empresa", type: "string", example: "12.345.678-9"),
                    new OA\Property(property: "email", type: "string", example: "contacto@empresa.cl"),
                    new OA\Property(property: "rubro", type: "string", example: "Tecnología"),
                    new OA\Property(property: "contacto_nombre", type: "string", example: "Juan Pérez"),
                    new OA\Property(property: "contacto_email", type: "string", example: "juan@empresa.cl"),
                    new OA\Property(property: "contacto_telefono", type: "string", example: "912345678")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 201,
                description: "Empresa creada"
            ),
            new OA\Response(
                response: 422,
                description: "Error de validación"
            )
        ]
    )]
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre_empresa' => 'required|string',
            'rut_empresa' => 'required|unique:empresas',
            'email' => 'required|email|unique:empresas',
            'rubro' => 'nullable|string',
            'contacto_nombre' => 'required|string',
            'contacto_email' => 'required|email',
            'contacto_telefono' => 'nullable|string',
        ]);

        $empresa = Empresa::create($validated);

        return response()->json($empresa, 201);
    }

    #[OA\Put(
        path: "/empresas/{id}",
        tags: ["Empresas"],
        summary: "Actualizar empresa",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        requestBody: new OA\RequestBody(
            required: true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property: "nombre_empresa", type: "string"),
                    new OA\Property(property: "email", type: "string"),
                    new OA\Property(property: "rubro", type: "string"),
                    new OA\Property(property: "contacto_nombre", type: "string"),
                    new OA\Property(property: "contacto_email", type: "string"),
                    new OA\Property(property: "contacto_telefono", type: "string")
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Empresa actualizada"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrada"
            )
        ]
    )]
    public function update(Request $request, Empresa $empresa)
    {
        $validated = $request->validate([
            'nombre_empresa' => 'sometimes|string',
            'email' => 'sometimes|email|unique:empresas,email,' . $empresa->id,
            'rubro' => 'nullable|string',
            'contacto_nombre' => 'nullable|string',
            'contacto_email' => 'nullable|email',
            'contacto_telefono' => 'nullable|string',
        ]);

        $empresa->update($validated);

        return response()->json($empresa);
    }

    #[OA\Delete(
        path: "/empresas/{id}",
        tags: ["Empresas"],
        summary: "Eliminar empresa",
        parameters: [
            new OA\Parameter(
                name: "id",
                in: "path",
                required: true,
                schema: new OA\Schema(type: "integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Empresa eliminada correctamente"
            ),
            new OA\Response(
                response: 404,
                description: "No encontrada"
            )
        ]
    )]
    public function destroy(Empresa $empresa)
    {
        $empresa->delete();

        return response()->json([
            "message" => "Empresa eliminada correctamente"
        ]);
    }
}
