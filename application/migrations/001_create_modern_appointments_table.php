<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_create_modern_appointments_table extends CI_Migration
{
    public function up()
    {
        // Create modern appointments table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE
            ],
            'patient_name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => FALSE
            ],
            'patient_phone' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => FALSE
            ],
            'patient_email' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => TRUE
            ],
            'appointment_date' => [
                'type' => 'DATE',
                'null' => FALSE
            ],
            'appointment_time' => [
                'type' => 'TIME',
                'null' => FALSE
            ],
            'doctor_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ],
            'center_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => FALSE
            ],
            'reason' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['booked', 'in_clinic', 'cancelled', 'rescheduled', 'no_show', 'visited', 'consultation', 'consultation_done'],
                'default' => 'booked'
            ],
            'patient_type' => [
                'type' => 'ENUM',
                'constraint' => ['new_patient', 'exist_patient'],
                'default' => 'new_patient'
            ],
            'crm_id' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => TRUE
            ],
            'notes' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'reschedule_reason' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'cancellation_reason' => [
                'type' => 'TEXT',
                'null' => TRUE
            ],
            'created_by' => [
                'type' => 'INT',
                'constraint' => 11,
                'null' => TRUE
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => 'CURRENT_TIMESTAMP'
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => FALSE,
                'default' => 'CURRENT_TIMESTAMP',
                'on_update' => 'CURRENT_TIMESTAMP'
            ],
            'cancelled_at' => [
                'type' => 'TIMESTAMP',
                'null' => TRUE
            ]
        ]);

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('patient_phone');
        $this->dbforge->add_key('appointment_date');
        $this->dbforge->add_key('doctor_id');
        $this->dbforge->add_key('center_id');
        $this->dbforge->add_key('status');
        $this->dbforge->add_key('crm_id');

        $this->dbforge->create_table('appointments', TRUE);

        // Add foreign key constraints if the referenced tables exist
        $this->addForeignKeys();
    }

    public function down()
    {
        $this->dbforge->drop_table('appointments', TRUE);
    }

    private function addForeignKeys()
    {
        // Check if doctors table exists
        if ($this->db->table_exists($this->config->item('db_prefix') . 'doctors')) {
            $this->db->query("ALTER TABLE `" . $this->config->item('db_prefix') . "appointments` 
                ADD CONSTRAINT `fk_appointments_doctor` 
                FOREIGN KEY (`doctor_id`) 
                REFERENCES `" . $this->config->item('db_prefix') . "doctors` (`id`) 
                ON DELETE RESTRICT ON UPDATE CASCADE");
        }

        // Check if centers table exists
        if ($this->db->table_exists($this->config->item('db_prefix') . 'centers')) {
            $this->db->query("ALTER TABLE `" . $this->config->item('db_prefix') . "appointments` 
                ADD CONSTRAINT `fk_appointments_center` 
                FOREIGN KEY (`center_id`) 
                REFERENCES `" . $this->config->item('db_prefix') . "centers` (`id`) 
                ON DELETE RESTRICT ON UPDATE CASCADE");
        }
    }
}
