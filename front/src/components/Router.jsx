import React from 'react';
import {
  BrowserRouter, Route, Switch,
} from 'react-router-dom';
import Login from './screens/Login';
import useToken from '../hooks/useToken';

const Router = () => {
  const { token, setToken } = useToken();

  if (!token) {
    return <Login setToken={setToken} />;
  }

  return (

    <BrowserRouter>
      <Switch>
        <Route path="/dashboard">
          <div>Dashboard</div>
        </Route>
        <Route path="/">
          <div>Root</div>
        </Route>
      </Switch>
    </BrowserRouter>
  );
};

export default Router;
