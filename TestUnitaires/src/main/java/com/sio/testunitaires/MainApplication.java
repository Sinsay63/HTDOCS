package com.sio.testunitaires;

import com.sio.rewrite.ArithmeticRewrite;

public class MainApplication {

    public static void main(String[] args) {
        ArithmeticRewrite test = new ArithmeticRewrite();
        System.out.println(test.getPGCD(50,20));
    }
}
