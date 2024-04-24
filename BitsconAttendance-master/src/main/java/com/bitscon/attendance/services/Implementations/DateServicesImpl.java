package com.bitscon.attendance.services.Implementations;

import com.bitscon.attendance.model.Date;
import com.bitscon.attendance.repositories.DateRepository;
import com.bitscon.attendance.services.DateServices;
import lombok.RequiredArgsConstructor;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@RequiredArgsConstructor
public class DateServicesImpl implements DateServices {

    private final DateRepository dateRepository;

    @Override
    public List<Date> getAllDates() {
        return dateRepository.findAll();
    }
}
