package com.bitscon.attendance.model;

import com.fasterxml.jackson.annotation.JsonIgnore;
import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.List;

@Entity
@Data
@NoArgsConstructor
@AllArgsConstructor
public class Date {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long dateID;

    private java.util.Date date;

    @JsonIgnore
    @ManyToMany(mappedBy = "dateId")
    private List<Attendee> attendeeId;
}
