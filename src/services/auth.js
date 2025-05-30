import axios from 'axios';

const API_URL = 'http://your-php-backend.com/api';

export const authService = {
  getCurrentUser: async () => {
    const response = await axios.get(`${API_URL}/user`, { withCredentials: true });
    return response.data;
  },
  logout: async () => {
    await axios.post(`${API_URL}/logout`, {}, { withCredentials: true });
  },
  handleOAuthCallback: async (code) => {
    const response = await axios.post(`${API_URL}/auth/callback`, { code }, { withCredentials: true });
    return response.data;
  }
};