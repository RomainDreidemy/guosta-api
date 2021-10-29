import React from 'react';
import {
  BrowserRouter, Redirect, Route, Switch,
} from 'react-router-dom';
import Login from './screens/Login';

const Router = () => (
  <BrowserRouter>
    <Switch>
      <Route path="/login">
        <Login />
      </Route>
      <Redirect to="/login" />
    </Switch>
  </BrowserRouter>

);

export default Router;
