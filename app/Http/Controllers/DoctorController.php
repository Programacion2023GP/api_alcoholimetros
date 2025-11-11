<?php

namespace App\Http\Controllers;

use App\Models\ApiResponse;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class DoctorController extends Controller
{
    public function createorUpdate(Request $request)
    {
        try {
            // Si el IDDetalleTipo existe (>0), buscamos el registro para actualizar
            $doctor = $request->id > 0
                ? Doctor::find($request->id)
                : new Doctor();

            if (!$doctor) {
                return ApiResponse::error('Doctores no encontrados', 404);
            }

            // Rellenamos solo los campos permitidos

            $doctor->name = $request->name;
            $doctor->active = $request->active;
            $doctor->certificate = $request->certificate;

            $doctor->save();

            $message = $request->id > 0
                ? 'Doctor  actualizado'
                : 'Doctor  creado';

            return ApiResponse::success($doctor, $message);
        } catch (Exception $e) {
            return ApiResponse::error('ocurrio un error', 500);
        }
    }

    public function index()
    {
        try {
            $doctor = Doctor::where("active", 1)->get();
            return ApiResponse::success($doctor, 'doctores recuperados con éxito');
        } catch (Exception $e) {
            return ApiResponse::error('Error al recuperar los doctores', 500);
        }
    }
    public function destroy(Request $request)
    {
        try {
            $doctor = Doctor::find($request->id);

            if (!$doctor) {
                return ApiResponse::error("Doctores no encontradas", 404);
            }

            $doctor->update(['active' => false]);
            return ApiResponse::success(null, 'doctor eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error("error ". $e->getMessage(),[]);
            return ApiResponse::error('Error al eliminar la doctor: ', 500);
        }
    }
}
