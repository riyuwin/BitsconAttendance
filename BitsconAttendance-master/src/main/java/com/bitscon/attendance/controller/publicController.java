package com.bitscon.attendance.controller;

import com.bitscon.attendance.model.Attendee;
import com.bitscon.attendance.services.AttendeeServices;
import com.bitscon.attendance.verification.RequestVerification;
import lombok.RequiredArgsConstructor;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api/public")
@RequiredArgsConstructor
@CrossOrigin(origins = "*")
public class publicController {
    private final AttendeeServices attendeeServices;

    @PostMapping("/attendance")
    public ResponseEntity<Attendee> addAttendee(@RequestBody Attendee attendee){
        if (!RequestVerification.validAttendee(attendee)) return new ResponseEntity<>(attendee, HttpStatus.BAD_REQUEST);
        Attendee newAttendee = attendeeServices.AddAttendance(attendee);
        if (newAttendee == null) return new ResponseEntity<>(attendee, HttpStatus.CONFLICT);
        return ResponseEntity.ok(newAttendee);
    }
}
