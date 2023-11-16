import { z } from 'zod';

export const signInSchema = z.object({
    email: z.string({
            required_error: 'Email is required',
            invalid_type_error: 'Email must be a string'
    })
        .email('Invalid Email'),
    password: z.string({
        required_error: 'Password is required',
        invalid_type_error: 'Password must be a string'
    }).min(8, 'Password must be at least 8 characters long'),
});