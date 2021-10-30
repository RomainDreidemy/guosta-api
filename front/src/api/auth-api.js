import React from 'react';
import instance from './index';

export const loginApi = async (data) => { // data = { username: "email@domain.com", password: "123" }
  try {
    return await instance.post('/login_check', data);
  } catch (error) {
    throw error;
  }
};
