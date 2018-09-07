/**
 * Interface for service to work with authorized user
 */
export interface LocalUser {
    /**
     * Check user is authorized
     * @returns {boolean}
     */
    isAuthorized(): boolean;

    /**
     * Set user tokens
     * @param {string} token
     * @param {string} refreshToken
     * @returns {LocalUser}
     */
    setTokens(token: string, refreshToken: string): LocalUser;

    /**
     * Get auth token
     * @returns {string}
     */
    getToken(): string;

    /**
     * Logout
     * @returns {LocalUser}
     */
    logout(): LocalUser;
}