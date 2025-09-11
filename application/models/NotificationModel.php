<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotificationModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('myhelper');
    }

    /**
     * Send appointment confirmation notification
     */
    public function sendAppointmentConfirmation($appointment)
    {
        $this->sendEmailNotification($appointment, 'confirmation');
        $this->sendSMSNotification($appointment, 'confirmation');
        $this->sendWhatsAppNotification($appointment, 'confirmation');
    }

    /**
     * Send status update notification
     */
    public function sendStatusUpdate($appointment, $status)
    {
        $this->sendEmailNotification($appointment, 'status_update', $status);
        $this->sendSMSNotification($appointment, 'status_update', $status);
    }

    /**
     * Send reschedule notification
     */
    public function sendRescheduleNotification($appointment)
    {
        $this->sendEmailNotification($appointment, 'reschedule');
        $this->sendSMSNotification($appointment, 'reschedule');
        $this->sendWhatsAppNotification($appointment, 'reschedule');
    }

    /**
     * Send cancellation notification
     */
    public function sendCancellationNotification($appointment)
    {
        $this->sendEmailNotification($appointment, 'cancellation');
        $this->sendSMSNotification($appointment, 'cancellation');
    }

    /**
     * Send email notification
     */
    private function sendEmailNotification($appointment, $type, $status = null)
    {
        if (empty($appointment['wife_email'])) {
            return false;
        }

        $subject = $this->getEmailSubject($type, $status);
        $message = $this->getEmailMessage($appointment, $type, $status);

        try {
            return send_mail($appointment['wife_email'], $subject, $message);
        } catch (Exception $e) {
            log_message('error', 'Email notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send SMS notification
     */
    private function sendSMSNotification($appointment, $type, $status = null)
    {
        if (empty($appointment['wife_phone'])) {
            return false;
        }
        $message = $this->getSMSMessage($appointment, $type, $status);
        try {
            return send_sms($appointment['wife_phone'], $message);
        } catch (Exception $e) {
            log_message('error', 'SMS notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send WhatsApp notification
     */
    private function sendWhatsAppNotification($appointment, $type)
    {
        if (empty($appointment['wife_phone'])) {
            return false;
        }
        try {
            $center_details = get_centre_details($appointment['appoitment_for']);
            $doctor_details = doctor_details($appointment['appoitmented_doctor']);
            $appointwhatmsg = [
                $appointment['wife_name'],
                $center_details['center_name'],
                date("d-m-Y", strtotime($appointment['appoitmented_date'])),
                $appointment['appoitmented_slot'],
                isset($center_details['center_location']) ? $center_details['center_location'] : ""
            ];
            return whatsappappointment(
                $appointment['wife_phone'],
                $appointment['wife_name'],
                $center_details['center_name'],
                date("d-m-Y", strtotime($appointment['appoitmented_date'])),
                $appointment['appoitmented_slot'],
                isset($center_details['center_location']) ? $center_details['center_location'] : ""
            );
        } catch (Exception $e) {
            log_message('error', 'WhatsApp notification failed: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Get email subject based on type
     */
    private function getEmailSubject($type, $status = null)
    {
        switch ($type) {
            case 'confirmation':
                return 'Appointment Confirmation - India IVF';
            case 'status_update':
                return 'Appointment Status Update - India IVF';
            case 'reschedule':
                return 'Appointment Rescheduled - India IVF';
            case 'cancellation':
                return 'Appointment Cancelled - India IVF';
            default:
                return 'Appointment Update - India IVF';
        }
    }

    /**
     * Get email message based on type
     */
    private function getEmailMessage($appointment, $type, $status = null)
    {
        $doctor_details = doctor_details($appointment['appoitmented_doctor']);
        $center_details = get_centre_details($appointment['appoitment_for']);
        $doctor_name = isset($doctor_details['name']) ? $doctor_details['name'] : 'Doctor';
        $center_name = isset($center_details['center_name']) ? $center_details['center_name'] : 'Center';
        $message = "Dear " . $appointment['wife_name'] . ",<br/><br/>";
        switch ($type) {
            case 'confirmation':
                $message .= "Your appointment has been confirmed with Dr. " . $doctor_name . 
                           " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                           " at " . $appointment['appoitmented_slot'] . 
                           " at " . $center_name . ".<br/><br/>";
                break;
            case 'status_update':
                $message .= "Your appointment status has been updated to: " . strtoupper($status) . 
                           " for Dr. " . $doctor_name . 
                           " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                           " at " . $appointment['appoitmented_slot'] . ".<br/><br/>";
                break;
            case 'reschedule':
                $message .= "Your appointment has been rescheduled with Dr. " . $doctor_name . 
                           " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                           " at " . $appointment['appoitmented_slot'] . 
                           " at " . $center_name . ".<br/><br/>";
                break;
            case 'cancellation':
                $message .= "Your appointment with Dr. " . $doctor_name . 
                           " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                           " at " . $appointment['appoitmented_slot'] . 
                           " has been cancelled.<br/><br/>";
                break;
        }
        
        $message .= "Please contact us if you have any questions.<br/><br/>";
        $message .= "Best regards,<br/>India IVF Team";
        return $message;
    }

    /**
     * Get SMS message based on type
     */
    private function getSMSMessage($appointment, $type, $status = null)
    {
        $doctor_details = doctor_details($appointment['appoitmented_doctor']);
        $center_details = get_centre_details($appointment['appoitment_for']);
        $doctor_name = isset($doctor_details['name']) ? $doctor_details['name'] : 'Doctor';
        $center_name = isset($center_details['center_name']) ? $center_details['center_name'] : 'Center';
        switch ($type) {
            case 'confirmation':
                return "Hi " . $appointment['wife_name'] . ", your appointment is confirmed with Dr. " . 
                       $doctor_name . " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                       " at " . $appointment['appoitmented_slot'] . " at " . $center_name . ".";
            case 'status_update':
                return "Hi " . $appointment['wife_name'] . ", your appointment status updated to " . 
                       strtoupper($status) . " for Dr. " . $doctor_name . 
                       " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                       " at " . $appointment['appoitmented_slot'] . ".";
            case 'reschedule':
                return "Hi " . $appointment['wife_name'] . ", your appointment is rescheduled with Dr. " . 
                       $doctor_name . " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                       " at " . $appointment['appoitmented_slot'] . " at " . $center_name . ".";
            case 'cancellation':
                return "Hi " . $appointment['wife_name'] . ", your appointment with Dr. " . 
                       $doctor_name . " on " . date("d-m-Y", strtotime($appointment['appoitmented_date'])) . 
                       " at " . $appointment['appoitmented_slot'] . " has been cancelled.";
            default:
                return "Hi " . $appointment['wife_name'] . ", your appointment details have been updated.";
        }
    }

    /**
     * Log notification
     */
    private function logNotification($appointment_id, $type, $channel, $status, $message = null)
    {
        $data = [
            'appointment_id' => $appointment_id,
            'notification_type' => $type,
            'channel' => $channel,
            'status' => $status,
            'message' => $message,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->db->insert('notification_logs', $data);
    }
}