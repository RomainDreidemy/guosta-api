import React from 'react';

const Login = () => (
  <div className="login__container">
    <form action="" className="login__container__form">
      <h1 className="login__container__form__title">Connexion</h1>
      <div className="login__container__form__group">
        <label className="login__container__form__group__label" htmlFor="email">
          Email
        </label>
        <input className="login__container__form__group__input" type="email" name="email" id="email" placeholder="Email" />

      </div>
      <div className="login__container__form__group">
        <label className="login__container__form__group__label" htmlFor="password">
          Mot de passe
        </label>
        <input className="login__container__form__group__input" type="password" name="password" id="password" placeholder="Mot de passe" />
      </div>

      <div className="login__container__form__group">
        <button className="login__container__form__group__submit" type="submit">Se connecter</button>
      </div>
    </form>
  </div>
);

export default Login;
