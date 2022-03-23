import { fetchWithDelay } from './fetch';
import routing from '../../website/routings';

const url = routing.get("api_jednostki");

const fetchUsers = () => fetchWithDelay(url);

export const userAPI = {
  fetchUsers,
};