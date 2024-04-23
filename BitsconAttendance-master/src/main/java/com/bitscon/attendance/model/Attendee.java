package com.bitscon.attendance.model;

import jakarta.persistence.*;
import lombok.AllArgsConstructor;
import lombok.Data;
import lombok.NoArgsConstructor;

import java.util.List;

@Entity
@Data
@NoArgsConstructor
@AllArgsConstructor
public class Attendee {

    @Id
    @GeneratedValue(strategy = GenerationType.IDENTITY)
    private Long AttendeeID;

    private String FName;
    private String MInitial;
    private String LName;
    private String number;
    private String school;

    @ManyToMany
    @JoinTable(name = "attendance", joinColumns = @JoinColumn(name = "attendee_id"), inverseJoinColumns = @JoinColumn(name = "date_id"))
    private List<Date> dateId;
}
