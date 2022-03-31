<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
            CREATE TRIGGER `t_insert_absensi_kerja` AFTER INSERT ON `tb_absensi_kerja` FOR EACH ROW
            BEGIN
                INSERT INTO `tb_logging` (`aksi`, `created_at`, `updated_at`) VALUES (CONCAT("Insert data ", NEW.`id`, " - ", NEW.`nama_karyawan`), NOW(), NOW());
            END
        ');

        DB::unprepared('
            CREATE TRIGGER `t_update_absensi_kerja` AFTER UPDATE ON `tb_absensi_kerja` FOR EACH ROW
            BEGIN
                INSERT INTO `tb_logging` (`aksi`, `created_at`, `updated_at`) VALUES (CONCAT("Update data ", NEW.`id`, " - ", NEW.`nama_karyawan`), NOW(), NOW());
            END
        ');

        DB::unprepared('
            CREATE TRIGGER `t_delete_absensi_kerja` AFTER DELETE ON `tb_absensi_kerja` FOR EACH ROW
            BEGIN
                INSERT INTO `tb_logging` (`aksi`, `created_at`, `updated_at`) VALUES (CONCAT("Delete data ", OLD.`id`, " - ", OLD.`nama_karyawan`), NOW(), NOW());
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `t_insert_absensi_kerja`');
        DB::unprepared('DROP TRIGGER `t_update_absensi_kerja`');
        DB::unprepared('DROP TRIGGER `t_delete_absensi_kerja`');
    }
};
