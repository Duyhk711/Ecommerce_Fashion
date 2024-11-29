<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 3, 'name' => 'Shop hoa qủa', 'guard_name' => 'web', 'created_at' => '2024-11-22 10:35:44', 'updated_at' => '2024-11-22 10:35:44'],
            ['id' => 4, 'name' => 'sdsdfs', 'guard_name' => 'web', 'created_at' => '2024-11-22 10:37:31', 'updated_at' => '2024-11-22 10:37:31'],
            ['id' => 11, 'name' => 'admin', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:23:28', 'updated_at' => '2024-11-22 12:23:28'],
            ['id' => 12, 'name' => 'thống kê', 'guard_name' => 'web', 'created_at' => '2024-11-22 13:58:24', 'updated_at' => '2024-11-22 13:58:24'],
        ]);

        DB::table('permissions')->insert([
            ['id' => 1, 'name' => 'view users', 'guard_name' => 'web', 'created_at' => '2024-11-22 10:02:15', 'updated_at' => '2024-11-22 10:02:15'],
            ['id' => 2, 'name' => 'edit users', 'guard_name' => 'web', 'created_at' => '2024-11-22 10:03:18', 'updated_at' => '2024-11-22 10:03:18'],
            ['id' => 3, 'name' => 'xem bảng điều khiển', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:18:38', 'updated_at' => '2024-11-22 12:18:42'],
            ['id' => 4, 'name' => 'xem danh sách sản phâm', 'guard_name' => 'web', 'created_at' => '2024-11-21 17:00:00', 'updated_at' => '2024-11-22 12:19:23'],
            ['id' => 5, 'name' => 'xem danh sách danh mục', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:19:28', 'updated_at' => '2024-11-22 12:19:31'],
            ['id' => 6, 'name' => 'xem danh sách thuộc tính', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:19:35', 'updated_at' => '2024-11-22 12:19:38'],
            ['id' => 7, 'name' => 'xem danh sách giá trị thuộc tính', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:19:42', 'updated_at' => '2024-11-22 12:19:49'],
            ['id' => 8, 'name' => 'xem danh sách khách hàng', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:19:52', 'updated_at' => '2024-11-22 12:19:55'],
            ['id' => 9, 'name' => 'xem danh sách nhân viên', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:19:59', 'updated_at' => '2024-11-22 12:20:01'],
            ['id' => 10, 'name' => 'xem danh sách đơn hàng', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:20:04', 'updated_at' => '2024-11-22 12:20:07'],
            ['id' => 11, 'name' => 'xem danh sách khuyến mãi', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:20:11', 'updated_at' => '2024-11-22 12:20:14'],
            ['id' => 12, 'name' => 'xem danh sách banner', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:20:18', 'updated_at' => '2024-11-22 12:20:21'],
            ['id' => 13, 'name' => 'xem danh sách bình luận', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:20:24', 'updated_at' => '2024-11-22 12:20:30'],
            ['id' => 14, 'name' => 'xem tin nhắn khách hàng', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:20:34', 'updated_at' => '2024-11-22 12:20:37'],
            ['id' => 15, 'name' => 'xem thống kê', 'guard_name' => 'web', 'created_at' => '2024-11-22 12:20:40', 'updated_at' => '2024-11-22 12:20:43'],
            ['id' => 16, 'name' => 'phân quyền', 'guard_name' => 'web', 'created_at' => '2024-11-22 14:15:06', 'updated_at' => '2024-11-22 14:15:06'],
            ['id' => 17, 'name' => 'Thêm mới sản phẩm', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:08', 'updated_at' => '2024-11-28 03:35:12'],
            ['id' => 18, 'name' => 'Chỉnh sửa sản phẩm', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:16', 'updated_at' => '2024-11-28 03:35:19'],
            ['id' => 19, 'name' => 'Xóa sản phẩm', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:24', 'updated_at' => '2024-11-28 03:35:27'],
            ['id' => 20, 'name' => 'Khôi phục sản phẩm', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:31', 'updated_at' => '2024-11-28 03:35:35'],
            ['id' => 21, 'name' => 'Thêm mới danh mục', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:39', 'updated_at' => '2024-11-28 03:35:42'],
            ['id' => 22, 'name' => 'Chỉnh sửa danh mục', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:46', 'updated_at' => '2024-11-28 03:35:49'],
            ['id' => 23, 'name' => 'Xóa danh mục', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:35:53', 'updated_at' => '2024-11-28 03:35:56'],
            ['id' => 24, 'name' => 'Kích hoạt danh mục', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:36:00', 'updated_at' => '2024-11-28 03:36:04'],
            ['id' => 25, 'name' => 'Thêm mới thuộc tính', 'guard_name' => 'web', 'created_at' => '2024-11-21 03:36:21', 'updated_at' => '2024-11-22 03:36:27'],
            ['id' => 26, 'name' => 'Thêm mới giá trị thuộc tính', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:36:35', 'updated_at' => '2024-11-28 03:36:39'],
            ['id' => 27, 'name' => 'Xóa giá trị thuộc tính', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:36:42', 'updated_at' => '2024-11-28 03:36:45'],
            ['id' => 28, 'name' => 'Chỉnh sửa giá trị thuộc tính', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:36:48', 'updated_at' => '2024-11-28 03:36:51'],
            ['id' => 29, 'name' => 'Chỉnh sửa trạng thái đơn hàng', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:36:54', 'updated_at' => '2024-11-28 03:36:57'],
            ['id' => 30, 'name' => 'Thêm mới khuyến mại', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:04', 'updated_at' => '2024-11-28 03:37:07'],
            ['id' => 31, 'name' => 'Chỉnh sửa khuyến mại', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:10', 'updated_at' => '2024-11-28 03:37:13'],
            ['id' => 32, 'name' => 'Xóa khuyến mại', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:17', 'updated_at' => '2024-11-28 03:37:19'],
            ['id' => 33, 'name' => 'Kích hoạt khuyến mại', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:23', 'updated_at' => '2024-11-28 03:37:26'],
            ['id' => 34, 'name' => 'Thêm mới banner', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:29', 'updated_at' => '2024-11-28 03:37:33'],
            ['id' => 35, 'name' => 'Chỉnh sửa banner', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:40', 'updated_at' => '2024-11-28 03:37:42'],
            ['id' => 36, 'name' => 'Xóa banner', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:45', 'updated_at' => '2024-11-28 03:37:48'],
            ['id' => 37, 'name' => 'Kích hoạt banner', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:52', 'updated_at' => '2024-11-28 03:37:54'],
            ['id' => 38, 'name' => 'Xóa bình luận', 'guard_name' => 'web', 'created_at' => '2024-11-28 03:37:57', 'updated_at' => '2024-11-28 03:38:02'],
        ]);

        DB::table('role_has_permissions')->insert([
            ['permission_id' => 1, 'role_id' => 11],
            ['permission_id' => 2, 'role_id' => 11],
            ['permission_id' => 3, 'role_id' => 11],
            ['permission_id' => 4, 'role_id' => 11],
            ['permission_id' => 5, 'role_id' => 11],
            ['permission_id' => 6, 'role_id' => 11],
            ['permission_id' => 7, 'role_id' => 11],
            ['permission_id' => 8, 'role_id' => 11],
            ['permission_id' => 9, 'role_id' => 11],
            ['permission_id' => 10, 'role_id' => 11],
            ['permission_id' => 11, 'role_id' => 11],
            ['permission_id' => 12, 'role_id' => 11],
            ['permission_id' => 13, 'role_id' => 11],
            ['permission_id' => 14, 'role_id' => 11],
            ['permission_id' => 15, 'role_id' => 11],
            ['permission_id' => 16, 'role_id' => 11],
            ['permission_id' => 17, 'role_id' => 11],
            ['permission_id' => 18, 'role_id' => 11],
            ['permission_id' => 19, 'role_id' => 11],
            ['permission_id' => 20, 'role_id' => 11],
            ['permission_id' => 21, 'role_id' => 11],
            ['permission_id' => 22, 'role_id' => 11],
            ['permission_id' => 23, 'role_id' => 11],
            ['permission_id' => 24, 'role_id' => 11],
            ['permission_id' => 25, 'role_id' => 11],
            ['permission_id' => 26, 'role_id' => 11],
            ['permission_id' => 27, 'role_id' => 11],
            ['permission_id' => 28, 'role_id' => 11],
            ['permission_id' => 29, 'role_id' => 11],
            ['permission_id' => 30, 'role_id' => 11],
            ['permission_id' => 31, 'role_id' => 11],
            ['permission_id' => 32, 'role_id' => 11],
            ['permission_id' => 33, 'role_id' => 11],
            ['permission_id' => 34, 'role_id' => 11],
            ['permission_id' => 35, 'role_id' => 11],
            ['permission_id' => 36, 'role_id' => 11],
            ['permission_id' => 37, 'role_id' => 11],
            ['permission_id' => 38, 'role_id' => 11],
            ['permission_id' => 4, 'role_id' => 12],
            ['permission_id' => 7, 'role_id' => 12],
            ['permission_id' => 15, 'role_id' => 12],
        ]);

        // Insert into model_has_roles
        DB::table('model_has_roles')->insert([
            ['role_id' => 11, 'model_type' => 'App\\Models\\User', 'model_id' => 18],
        ]);
    }
}
