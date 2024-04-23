package com.bitscon.attendance.services.Implementations;

import com.bitscon.attendance.model.Attendee;
import com.bitscon.attendance.repositories.AttendeeRepository;
import com.bitscon.attendance.repositories.DateRepository;
import com.bitscon.attendance.services.AttendeeServices;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

import java.text.ParseException;
import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;

@Service
@RequiredArgsConstructor
public class AttendeeServicesImpl implements AttendeeServices {
    private final AttendeeRepository attendeeRepository;
    private final DateRepository dateRepository;

    @Override
    public Attendee AddAttendance(Attendee newAttendee) {
        // get attendee if exists
        Attendee oldAttendee = attendeeRepository.findByFNameAndMInitialAndLNameAndNumberAndSchool(newAttendee.getFName(), newAttendee.getMInitial(), newAttendee.getLName(), newAttendee.getNumber(), newAttendee.getSchool());

        //if attendee doesn't exist, save new instance of this attendee and get the attendee instance
        if (oldAttendee == null) {
            newAttendee.setDateId(new ArrayList<>());
            oldAttendee = attendeeRepository.save(newAttendee);
        }

        //get current Date data
        long currentTimeMillis = System.currentTimeMillis();
        Date currentDate = new Date(currentTimeMillis);

        //simplify current Date data
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
        String formattedCurrentDate = formatter.format(currentDate);
        try {
            currentDate = formatter.parse(formattedCurrentDate);
        } catch (ParseException e) {
            throw new RuntimeException(e);
        }
        com.bitscon.attendance.model.Date lastRecord = dateRepository.findFirstByOrderByDateIDDesc();
        if (lastRecord != null) {
            String formattedLastRecord = formatter.format(lastRecord.getDate());
            try {
                lastRecord.setDate(formatter.parse(formattedLastRecord));
            } catch (ParseException e) {
                throw new RuntimeException(e);
            }
        }

        //Compare
        if (lastRecord == null || currentDate.compareTo(lastRecord.getDate()) != 0) {
            com.bitscon.attendance.model.Date newDate = new com.bitscon.attendance.model.Date();
            newDate.setDate(currentDate);
            lastRecord = dateRepository.save(newDate);
        }

        //check if last record exists in attendee
        if (oldAttendee.getDateId().contains(lastRecord)) {
            return null;
        }

        //save current Date data
        oldAttendee.getDateId().add(lastRecord);

        //save attendee
        return attendeeRepository.save(oldAttendee);
    }

    @Override
    public List<Attendee> viewAllAttendance() {
        return attendeeRepository.findAll();
    }

    @Override
    public List<Attendee> viewFilteredAttendance(String schoolFilter, String dateFilter) {
        Date formattedCurrentDate;
        List<com.bitscon.attendance.model.Date> listedDate = new ArrayList<>();
        SimpleDateFormat formatter = new SimpleDateFormat("yyyy-MM-dd");
        if (dateFilter != null) {
            try {
                formattedCurrentDate = formatter.parse(dateFilter);
            } catch (ParseException e) {
                throw new RuntimeException(e);
            }
            com.bitscon.attendance.model.Date findDate = dateRepository.findByDate(formattedCurrentDate);
            listedDate.add(findDate);
            if (schoolFilter != null) {
                return attendeeRepository.findAllBySchoolAndDateIdIn(schoolFilter, listedDate);
            } else {
                return attendeeRepository.findAllByDateIdIn(listedDate);
            }
        }
        else if (schoolFilter != null) {
            return attendeeRepository.findAllBySchool(schoolFilter);
        } else {
            return attendeeRepository.findAll();
        }
    }
}
