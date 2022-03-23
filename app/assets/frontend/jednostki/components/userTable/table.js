import React from 'react';
import { Table } from '../../common/components/table';
import { Header } from './header';
import { Row } from './row';

export const UserTable = (props) => (
  <Table
    title="Jednostki"
    id="jednostki"
    items={props.users}
    headerRender={Header}
    rowRender={Row}
  />
);