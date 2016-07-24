package br.cefetmg.em.domain.repository;

import java.util.List;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.stereotype.Repository;
import org.springframework.transaction.annotation.Transactional;

import br.cefetmg.em.domain.User;
import br.cefetmg.em.domain.UserRoles;


@Repository
public interface UserRolesRepository extends JpaRepository<UserRoles, Long> {
	
	@Query("SELECT ur.role from UserRoles ur, User u WHERE u.username = ?1 and u.userId = ur.user.userId")
	public List<String> findByUserUsername(String username);
	
	@Transactional
	public void deleteByUser(User u);

}
