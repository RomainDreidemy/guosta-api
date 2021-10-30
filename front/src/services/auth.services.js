import { loginApi } from '../api/auth-api';

export const login = async (datas) => {
  try {
    const { data } = await loginApi(datas);
    await localStorage.setItem('token', data.token);
    return data;
  } catch (error) {
    throw error;
  }
};

export const getToken = async () => {
  const token = await localStorage.getItem('token');
  return token;
};
