package com.sio.rewrite;

import com.sio.Arithmetic;

public class ArithmeticRewrite extends Arithmetic {

    @Override
    public int getFibonacci(int entier) {
        int result;
        if (entier < 0) {
            result = -1;
        }
        else if (entier == 0) {
            result = 0;
        }
        else if (entier == 1) {
            result = 1;
        }
        else {
            result = getFibonacci(entier - 1) + getFibonacci(entier - 2);
        }
        return result;
    }

    @Override
    public boolean isPrimeNumber(final int numberToTest) {
        boolean isPrime = true;
        if (numberToTest < 2) {
            return false;
        }
        for (int cpt = 2; cpt < numberToTest; ++cpt) {
            if (numberToTest % cpt != 1) {
                isPrime = false;
                break;
            }
        }
        return isPrime;
    }
}
