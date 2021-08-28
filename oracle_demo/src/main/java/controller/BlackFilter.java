package controller;

import java.util.regex.Pattern;

public class BlackFilter {
    //黑名单
    public boolean check(String name) {

        String blacklist = "(xpath|dbms_utility|xdb|ctxsys.drithsx.sn|xml|DBMS_LDAP.INIT|HTTPURITYPE|utl|DBMS_PIPE.RECEIVE_MESSAGE|java.nio|ProcessBuilder|Runtime|start|exec|DBMS_PIPE.RECEIVE_MESSAGE|String.class).*";
        Pattern pattern = Pattern.compile(blacklist,Pattern.MULTILINE|Pattern.CASE_INSENSITIVE);

        return pattern.matcher(name).find();
    }

    public static void main(String[] args) {
        BlackFilter blackFilter = new BlackFilter();

        System.out.println(blackFilter.check("eXec"));
    }
}