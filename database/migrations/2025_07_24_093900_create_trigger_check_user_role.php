<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Trigger per TECNICO_ASSISTENZA
        DB::unprepared("
            CREATE TRIGGER check_tecnico_role
            BEFORE INSERT ON tecnico_assistenza
            FOR EACH ROW
            BEGIN
                DECLARE user_role VARCHAR(20);
                SELECT role INTO user_role FROM users WHERE id = NEW.id_utente;

                IF user_role IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Utente non esistente.';
                ELSEIF user_role <> 'tecnico' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ruolo non valido per tecnico_assistenza.';
                END IF;
            END;
        ");

        // Trigger per STAFF_TECNICO
        DB::unprepared("
            CREATE TRIGGER check_staff_role
            BEFORE INSERT ON staff_tecnico
            FOR EACH ROW
            BEGIN
                DECLARE user_role VARCHAR(20);
                SELECT role INTO user_role FROM users WHERE id = NEW.id_utente;

                IF user_role IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Utente non esistente.';
                ELSEIF user_role <> 'staff' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ruolo non valido per staff_tecnico.';
                END IF;
            END;
        ");

        // Trigger per AMMINISTRATORE
        DB::unprepared("
            CREATE TRIGGER check_admin_role
            BEFORE INSERT ON admin
            FOR EACH ROW
            BEGIN
                DECLARE user_role VARCHAR(20);
                SELECT role INTO user_role FROM users WHERE id = NEW.id_utente;

                IF user_role IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Utente non esistente.';
                ELSEIF user_role <> 'admin' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ruolo non valido per amministratore.';
                END IF;
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS check_tecnico_role;");
        DB::unprepared("DROP TRIGGER IF EXISTS check_staff_role;");
        DB::unprepared("DROP TRIGGER IF EXISTS check_admin_role;");
    }
};
