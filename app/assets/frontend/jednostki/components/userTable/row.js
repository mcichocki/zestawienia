import React from 'react';

export const Row = (user) => (
  <tr key={user.id}>
    <td width={40}>
      <span>{user.nazwa}</span>
    </td>
    <td>
      <span>{user.ulica}</span>
    </td>
    <td>
      <span>{user.numer}</span>
    </td>
    <td>
      <span>{user.kodPocztowy}</span>
    </td>
    <td>
      <span>{user.identyfikator}</span>
    </td>
    <td>
      <span>{user.miasto}</span>
    </td>
  </tr>
);