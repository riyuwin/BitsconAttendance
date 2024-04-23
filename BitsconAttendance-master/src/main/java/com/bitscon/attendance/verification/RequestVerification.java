package com.bitscon.attendance.verification;

import com.bitscon.attendance.model.Attendee;

public class RequestVerification {
    public static boolean validAttendee(Attendee attendee){
        return notNull(attendee.getNumber()) && notNull(attendee.getSchool()) && notNull(attendee.getFName())
                && notNull(attendee.getMInitial()) && notNull(attendee.getLName());
    }
    private static boolean notNull(Object object){
        return object != null;
    }
}
