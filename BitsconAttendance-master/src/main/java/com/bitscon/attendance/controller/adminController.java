package com.bitscon.attendance.controller;


import com.bitscon.attendance.dto.Filter;
import com.bitscon.attendance.model.Attendee;
import com.bitscon.attendance.model.Date;
import com.bitscon.attendance.services.AttendeeServices;
import com.bitscon.attendance.services.DateServices;
import lombok.RequiredArgsConstructor;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/admin")
@RequiredArgsConstructor
@CrossOrigin(origins = "*")
public class adminController {
    private final AttendeeServices attendeeServices;
    private final DateServices dateServices;

    @GetMapping("/attendance/view/all")
    public ResponseEntity<List<Attendee>> getAllAttendance() {
        return ResponseEntity.ok(attendeeServices.viewAllAttendance());
    }

    @PostMapping("/attendance/view/filtered")
    public ResponseEntity<List<Attendee>> getFilteredAttendance(@RequestBody Filter filter) {
        Filter newFilter = new Filter();
        newFilter.setDate("SELECT_ALL".equals(filter.getDate()) ? null : filter.getDate());
        newFilter.setSchool("SELECT_ALL".equals(filter.getSchool()) ? null : filter.getSchool());
        return ResponseEntity.ok(attendeeServices.viewFilteredAttendance(newFilter.getSchool(), newFilter.getDate()));
    }

    @GetMapping("/attendance/view/dates")
    public ResponseEntity<List<Date>> getAllDates() {
        return ResponseEntity.ok(dateServices.getAllDates());
    }
}
