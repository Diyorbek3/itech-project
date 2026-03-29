<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MyCourceController extends Controller
{
    public function index()
    {
        $courses = DB::table('my_course')
            ->leftJoin('framework', 'my_course.id_fremwork', '=', 'framework.id')
            ->leftJoin('interpretator', 'my_course.id_interpretator', '=', 'interpretator.id')
            ->select(
                'my_course.*',
                'framework.name as framework_name',
                'interpretator.name as interpretator_name'
            )
            ->orderBy('my_course.created_at', 'desc')
            ->get();

        $frameworks = DB::table('framework')->orderBy('name')->get();
        $interpretators = DB::table('interpretator')->orderBy('name')->get();

        return view('my-courses.index', compact('courses', 'frameworks', 'interpretators'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'id_fremwork' => 'nullable|exists:framework,id',
                'id_interpretator' => 'nullable|exists:interpretator,id',
                'duration_time' => 'nullable|string|max:50',
                'mentor_name' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
            ]);

            $imagePath = null;
            if ($request->hasFile('img')) {
                $imagePath = $request->file('img')->store('courses', 'public');
            }

            $courseId = DB::table('my_course')->insertGetId([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'img' => $imagePath,
                'id_fremwork' => $validated['id_fremwork'] ?? null,
                'id_interpretator' => $validated['id_interpretator'] ?? null,
                'duration_time' => $validated['duration_time'] ?? null,
                'mentor_name' => $validated['mentor_name'] ?? null,
                'price' => $validated['price'] ?? null,
                'created_by' => auth()->id(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Курс успешно создан',
                'course_id' => $courseId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при создании курса: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'id_fremwork' => 'nullable|exists:framework,id',
                'id_interpretator' => 'nullable|exists:interpretator,id',
                'duration_time' => 'nullable|string|max:50',
                'mentor_name' => 'nullable|string|max:255',
                'price' => 'nullable|numeric|min:0',
            ]);

            $course = DB::table('my_course')->where('id', $id)->first();
            
            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Курс не найден'
                ], 404);
            }

            $updateData = [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'id_fremwork' => $validated['id_fremwork'] ?? null,
                'id_interpretator' => $validated['id_interpretator'] ?? null,
                'duration_time' => $validated['duration_time'] ?? null,
                'mentor_name' => $validated['mentor_name'] ?? null,
                'price' => $validated['price'] ?? null,
                'updated_at' => now(),
            ];

            if ($request->hasFile('img')) {
                if ($course->img && Storage::disk('public')->exists($course->img)) {
                    Storage::disk('public')->delete($course->img);
                }
                $updateData['img'] = $request->file('img')->store('courses', 'public');
            }

            DB::table('my_course')->where('id', $id)->update($updateData);

            return response()->json([
                'success' => true,
                'message' => 'Курс успешно обновлен'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при обновлении курса: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $course = DB::table('my_course')->where('id', $id)->first();
            
            if (!$course) {
                return response()->json([
                    'success' => false,
                    'message' => 'Курс не найден'
                ], 404);
            }

            if ($course->img && Storage::disk('public')->exists($course->img)) {
                Storage::disk('public')->delete($course->img);
            }

            DB::table('course_category')->where('course_id', $id)->delete();
            DB::table('my_course')->where('id', $id)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Курс успешно удален'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении курса: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        $course = DB::table('my_course')
            ->leftJoin('framework', 'my_course.id_fremwork', '=', 'framework.id')
            ->leftJoin('interpretator', 'my_course.id_interpretator', '=', 'interpretator.id')
            ->select(
                'my_course.*',
                'framework.name as framework_name',
                'interpretator.name as interpretator_name'
            )
            ->where('my_course.id', $id)
            ->first();

        if (!$course) {
            return response()->json([
                'success' => false,
                'message' => 'Курс не найден'
            ], 404);
        }

        $categories = DB::table('course_category')
            ->where('course_id', $id)
            ->get();

        return response()->json([
            'success' => true,
            'course' => $course,
            'categories' => $categories
        ]);
    }

    public function addCategory(Request $request, $courseId)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:64',
                'description' => 'nullable|string'
            ]);

            $categoryId = DB::table('course_category')->insertGetId([
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'course_id' => $courseId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Категория успешно добавлена',
                'category_id' => $categoryId
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при добавлении категории: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteCategory($categoryId)
    {
        try {
            DB::table('course_category')->where('id', $categoryId)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Категория успешно удалена'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ошибка при удалении категории: ' . $e->getMessage()
            ], 500);
        }
    }
}