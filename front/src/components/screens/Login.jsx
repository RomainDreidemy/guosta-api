import React, { useState } from 'react';
import PropTypes from 'prop-types';
import { yupResolver } from '@hookform/resolvers/yup';
import * as yup from 'yup';
import { useForm } from 'react-hook-form';
import { BeatLoader } from 'react-spinners';
import { login } from '../../services/auth.services';

const schema = yup.object({
  username: yup.string()
    .email('Merci de rentrer une adresse email.')
    .required('Ce champ est obligatoire.'),
  password: yup.string().required(),
}).required();

const Login = ({ setToken }) => {
  const [isLoading, setIsLoading] = useState(false);
  const {
    register, handleSubmit, formState: { errors },
  } = useForm({ resolver: yupResolver(schema) });
  const onSubmit = async (data) => {
    setIsLoading(true);
    const token = await login(data);
    setToken(token);
    setIsLoading(false);
  };

  return (
    <div className="login__container">
      <form action="" className="login__container__form" onSubmit={handleSubmit(onSubmit)}>
        <h1 className="login__container__form__title">Connexion</h1>
        <div className="login__container__form__group">
          <input
            className="login__container__form__group__input"
            type="text"
            name="email"
            id="email"
            placeholder="Email"
            {...register('username', { required: true })}
          />
          <span className="login__container__form__group__error">{errors.username?.message}</span>
        </div>
        <div className="login__container__form__group">
          <input
            className="login__container__form__group__input"
            type="password"
            name="password"
            id="password"
            placeholder="Mot de passe"
            {...register('password')}
          />
          <span className="login__container__form__group__error">{errors.password?.message}</span>
        </div>

        <div className="login__container__form__group">
          <button className="login__container__form__group__submit" type="submit" disabled={isLoading}>{isLoading ? <BeatLoader color="#fff" /> : 'Se connecter'}</button>
        </div>
      </form>
    </div>
  );
};

Login.propTypes = {
  setToken: PropTypes.func.isRequired,
};

export default Login;
