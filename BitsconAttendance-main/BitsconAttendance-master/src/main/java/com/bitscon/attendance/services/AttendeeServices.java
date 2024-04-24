package com.bitscon.attendance.services;

import com.bitscon.attendance.model.Attendee;

import java.util.List;

public interface AttendeeServices {
    Attendee AddAttendance(Attendee attendee);
    List<Attendee> viewAllAttendance();
    List<Attendee> viewFilteredAttendance(String schoolFilter, String dateFilter);
}
