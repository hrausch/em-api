package br.cefetmg.em.model;

import java.sql.Timestamp;
import java.util.HashSet;
import java.util.Set;

import javax.persistence.Column;
import javax.persistence.Entity;
import javax.persistence.FetchType;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.OneToMany;
import javax.persistence.Table;

@Entity
@Table(name = "users")
public class User  {

	


	@Id
	@GeneratedValue(strategy=GenerationType.IDENTITY)
	@Column(name = "user_id", unique = true)
	private Long userId;
	
	@Column(name = "username", unique = true, 
			nullable = false, length = 45)
	private String username;
	
	@Column(name = "password", 
			nullable = false, length = 60)
	private String password;
	
	@Column(name = "enabled", nullable = false)
	private boolean enabled;
	
	private String email;

	private String name;

	@Column(name="last_access")
	private Timestamp lastAccess;
	
	@OneToMany(fetch = FetchType.LAZY, mappedBy = "user")
	private Set<UserRoles> userRole = new HashSet<UserRoles>(0);

	public User() {
	}


	public User(User u){
		this.userId = u.userId;
		this.username = u.username;
		this.password = u.password;
		this.enabled = u.enabled;
	}

	
	public Long getUserId() {
		return userId;
	}

	public void setUserId(Long userId) {
		this.userId = userId;
	}

	public String getEmail() {
		return email;
	}


	public void setEmail(String email) {
		this.email = email;
	}


	public String getName() {
		return name;
	}


	public void setName(String name) {
		this.name = name;
	}


	public Timestamp getLastAccess() {
		return lastAccess;
	}


	public void setLastAccess(Timestamp lastAccess) {
		this.lastAccess = lastAccess;
	}


	public String getUsername() {
		return this.username;
	}

	public void setUsername(String username) {
		this.username = username;
	}


	public String getPassword() {
		return this.password;
	}

	public void setPassword(String password) {
		this.password = password;
	}


	public boolean isEnabled() {
		return this.enabled;
	}

	public void setEnabled(boolean enabled) {
		this.enabled = enabled;
	}


	public Set<UserRoles> getUserRole() {
		return this.userRole;
	}

	public void setUserRole(Set<UserRoles> userRole) {
		this.userRole = userRole;
	}

}
