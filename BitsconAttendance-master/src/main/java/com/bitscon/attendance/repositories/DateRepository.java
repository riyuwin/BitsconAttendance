package com.bitscon.attendance.repositories;

import com.bitscon.attendance.model.Date;
import org.springframework.data.jpa.repository.JpaRepository;

public interface DateRepository extends JpaRepository<Date, Long> {
    Date findFirstByOrderByDateIDDesc();
    Date findByDate(java.util.Date date);
}
