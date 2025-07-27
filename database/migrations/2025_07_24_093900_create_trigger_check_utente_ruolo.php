<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Trigger per TECNICO_ASSISTENZA
        DB::unprepared("
            CREATE TRIGGER check_tecnico_ruolo
            BEFORE INSERT ON tecnico_assistenza
            FOR EACH ROW
            BEGIN
                DECLARE user_ruolo VARCHAR(20);
                SELECT ruolo INTO user_ruolo FROM users WHERE id = NEW.id_utente;

                IF user_ruolo IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Utente non esistente.';
                ELSEIF user_ruolo <> 'tecnico' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ruolo non valido per tecnico_assistenza.';
                END IF;
            END;
        ");

        // Trigger per STAFF_TECNICO
        DB::unprepared("
            CREATE TRIGGER check_staff_ruolo
            BEFORE INSERT ON staff_tecnico
            FOR EACH ROW
            BEGIN
                DECLARE user_ruolo VARCHAR(20);
                SELECT ruolo INTO user_ruolo FROM users WHERE id = NEW.id_utente;

                IF user_ruolo IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Utente non esistente.';
                ELSEIF user_ruolo <> 'staff' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ruolo non valido per staff_tecnico.';
                END IF;
            END;
        ");

        // Trigger per AMMINISTRATORE
        DB::unprepared("
            CREATE TRIGGER check_admin_ruolo
            BEFORE INSERT ON admin
            FOR EACH ROW
            BEGIN
                DECLARE user_ruolo VARCHAR(20);
                SELECT ruolo INTO user_ruolo FROM users WHERE id = NEW.id_utente;

                IF user_ruolo IS NULL THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Utente non esistente.';
                ELSEIF user_ruolo <> 'admin' THEN
                    SIGNAL SQLSTATE '45000'
                    SET MESSAGE_TEXT = 'Ruolo non valido per amministratore.';
                END IF;
            END;
        ");
    }

    public function down(): void
    {
        DB::unprepared("DROP TRIGGER IF EXISTS check_tecnico_ruolo;");
        DB::unprepared("DROP TRIGGER IF EXISTS check_staff_ruolo;");
        DB::unprepared("DROP TRIGGER IF EXISTS check_admin_ruolo;");
    }
};
