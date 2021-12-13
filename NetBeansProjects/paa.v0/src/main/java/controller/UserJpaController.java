/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import controller.exceptions.IllegalOrphanException;
import controller.exceptions.NonexistentEntityException;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entity.Role;
import entity.Maison;
import java.util.ArrayList;
import java.util.Collection;
import entity.Logement;
import entity.User;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

/**
 *
 * @author mathieudielna
 */
public class UserJpaController implements Serializable {

    public UserJpaController(EntityManagerFactory emf) {
        this.emf = emf;
    }
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(User user) {
        if (user.getMaisonCollection() == null) {
            user.setMaisonCollection(new ArrayList<Maison>());
        }
        if (user.getLogementCollection() == null) {
            user.setLogementCollection(new ArrayList<Logement>());
        }
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Role idRole = user.getIdRole();
            if (idRole != null) {
                idRole = em.getReference(idRole.getClass(), idRole.getIdRole());
                user.setIdRole(idRole);
            }
            Collection<Maison> attachedMaisonCollection = new ArrayList<Maison>();
            for (Maison maisonCollectionMaisonToAttach : user.getMaisonCollection()) {
                maisonCollectionMaisonToAttach = em.getReference(maisonCollectionMaisonToAttach.getClass(), maisonCollectionMaisonToAttach.getIdLogement());
                attachedMaisonCollection.add(maisonCollectionMaisonToAttach);
            }
            user.setMaisonCollection(attachedMaisonCollection);
            Collection<Logement> attachedLogementCollection = new ArrayList<Logement>();
            for (Logement logementCollectionLogementToAttach : user.getLogementCollection()) {
                logementCollectionLogementToAttach = em.getReference(logementCollectionLogementToAttach.getClass(), logementCollectionLogementToAttach.getIdLogement());
                attachedLogementCollection.add(logementCollectionLogementToAttach);
            }
            user.setLogementCollection(attachedLogementCollection);
            em.persist(user);
            if (idRole != null) {
                idRole.getUserCollection().add(user);
                idRole = em.merge(idRole);
            }
            for (Maison maisonCollectionMaison : user.getMaisonCollection()) {
                User oldIdUserOfMaisonCollectionMaison = maisonCollectionMaison.getIdUser();
                maisonCollectionMaison.setIdUser(user);
                maisonCollectionMaison = em.merge(maisonCollectionMaison);
                if (oldIdUserOfMaisonCollectionMaison != null) {
                    oldIdUserOfMaisonCollectionMaison.getMaisonCollection().remove(maisonCollectionMaison);
                    oldIdUserOfMaisonCollectionMaison = em.merge(oldIdUserOfMaisonCollectionMaison);
                }
            }
            for (Logement logementCollectionLogement : user.getLogementCollection()) {
                User oldIdUserOfLogementCollectionLogement = logementCollectionLogement.getIdUser();
                logementCollectionLogement.setIdUser(user);
                logementCollectionLogement = em.merge(logementCollectionLogement);
                if (oldIdUserOfLogementCollectionLogement != null) {
                    oldIdUserOfLogementCollectionLogement.getLogementCollection().remove(logementCollectionLogement);
                    oldIdUserOfLogementCollectionLogement = em.merge(oldIdUserOfLogementCollectionLogement);
                }
            }
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(User user) throws IllegalOrphanException, NonexistentEntityException, Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            User persistentUser = em.find(User.class, user.getIdUser());
            Role idRoleOld = persistentUser.getIdRole();
            Role idRoleNew = user.getIdRole();
            Collection<Maison> maisonCollectionOld = persistentUser.getMaisonCollection();
            Collection<Maison> maisonCollectionNew = user.getMaisonCollection();
            Collection<Logement> logementCollectionOld = persistentUser.getLogementCollection();
            Collection<Logement> logementCollectionNew = user.getLogementCollection();
            List<String> illegalOrphanMessages = null;
            for (Maison maisonCollectionOldMaison : maisonCollectionOld) {
                if (!maisonCollectionNew.contains(maisonCollectionOldMaison)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Maison " + maisonCollectionOldMaison + " since its idUser field is not nullable.");
                }
            }
            for (Logement logementCollectionOldLogement : logementCollectionOld) {
                if (!logementCollectionNew.contains(logementCollectionOldLogement)) {
                    if (illegalOrphanMessages == null) {
                        illegalOrphanMessages = new ArrayList<String>();
                    }
                    illegalOrphanMessages.add("You must retain Logement " + logementCollectionOldLogement + " since its idUser field is not nullable.");
                }
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            if (idRoleNew != null) {
                idRoleNew = em.getReference(idRoleNew.getClass(), idRoleNew.getIdRole());
                user.setIdRole(idRoleNew);
            }
            Collection<Maison> attachedMaisonCollectionNew = new ArrayList<Maison>();
            for (Maison maisonCollectionNewMaisonToAttach : maisonCollectionNew) {
                maisonCollectionNewMaisonToAttach = em.getReference(maisonCollectionNewMaisonToAttach.getClass(), maisonCollectionNewMaisonToAttach.getIdLogement());
                attachedMaisonCollectionNew.add(maisonCollectionNewMaisonToAttach);
            }
            maisonCollectionNew = attachedMaisonCollectionNew;
            user.setMaisonCollection(maisonCollectionNew);
            Collection<Logement> attachedLogementCollectionNew = new ArrayList<Logement>();
            for (Logement logementCollectionNewLogementToAttach : logementCollectionNew) {
                logementCollectionNewLogementToAttach = em.getReference(logementCollectionNewLogementToAttach.getClass(), logementCollectionNewLogementToAttach.getIdLogement());
                attachedLogementCollectionNew.add(logementCollectionNewLogementToAttach);
            }
            logementCollectionNew = attachedLogementCollectionNew;
            user.setLogementCollection(logementCollectionNew);
            user = em.merge(user);
            if (idRoleOld != null && !idRoleOld.equals(idRoleNew)) {
                idRoleOld.getUserCollection().remove(user);
                idRoleOld = em.merge(idRoleOld);
            }
            if (idRoleNew != null && !idRoleNew.equals(idRoleOld)) {
                idRoleNew.getUserCollection().add(user);
                idRoleNew = em.merge(idRoleNew);
            }
            for (Maison maisonCollectionNewMaison : maisonCollectionNew) {
                if (!maisonCollectionOld.contains(maisonCollectionNewMaison)) {
                    User oldIdUserOfMaisonCollectionNewMaison = maisonCollectionNewMaison.getIdUser();
                    maisonCollectionNewMaison.setIdUser(user);
                    maisonCollectionNewMaison = em.merge(maisonCollectionNewMaison);
                    if (oldIdUserOfMaisonCollectionNewMaison != null && !oldIdUserOfMaisonCollectionNewMaison.equals(user)) {
                        oldIdUserOfMaisonCollectionNewMaison.getMaisonCollection().remove(maisonCollectionNewMaison);
                        oldIdUserOfMaisonCollectionNewMaison = em.merge(oldIdUserOfMaisonCollectionNewMaison);
                    }
                }
            }
            for (Logement logementCollectionNewLogement : logementCollectionNew) {
                if (!logementCollectionOld.contains(logementCollectionNewLogement)) {
                    User oldIdUserOfLogementCollectionNewLogement = logementCollectionNewLogement.getIdUser();
                    logementCollectionNewLogement.setIdUser(user);
                    logementCollectionNewLogement = em.merge(logementCollectionNewLogement);
                    if (oldIdUserOfLogementCollectionNewLogement != null && !oldIdUserOfLogementCollectionNewLogement.equals(user)) {
                        oldIdUserOfLogementCollectionNewLogement.getLogementCollection().remove(logementCollectionNewLogement);
                        oldIdUserOfLogementCollectionNewLogement = em.merge(oldIdUserOfLogementCollectionNewLogement);
                    }
                }
            }
            em.getTransaction().commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                Integer id = user.getIdUser();
                if (findUser(id) == null) {
                    throw new NonexistentEntityException("The user with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(Integer id) throws IllegalOrphanException, NonexistentEntityException {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            User user;
            try {
                user = em.getReference(User.class, id);
                user.getIdUser();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The user with id " + id + " no longer exists.", enfe);
            }
            List<String> illegalOrphanMessages = null;
            Collection<Maison> maisonCollectionOrphanCheck = user.getMaisonCollection();
            for (Maison maisonCollectionOrphanCheckMaison : maisonCollectionOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This User (" + user + ") cannot be destroyed since the Maison " + maisonCollectionOrphanCheckMaison + " in its maisonCollection field has a non-nullable idUser field.");
            }
            Collection<Logement> logementCollectionOrphanCheck = user.getLogementCollection();
            for (Logement logementCollectionOrphanCheckLogement : logementCollectionOrphanCheck) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This User (" + user + ") cannot be destroyed since the Logement " + logementCollectionOrphanCheckLogement + " in its logementCollection field has a non-nullable idUser field.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            Role idRole = user.getIdRole();
            if (idRole != null) {
                idRole.getUserCollection().remove(user);
                idRole = em.merge(idRole);
            }
            em.remove(user);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public List<User> findUserEntities() {
        return findUserEntities(true, -1, -1);
    }

    public List<User> findUserEntities(int maxResults, int firstResult) {
        return findUserEntities(false, maxResults, firstResult);
    }

    private List<User> findUserEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(User.class));
            Query q = em.createQuery(cq);
            if (!all) {
                q.setMaxResults(maxResults);
                q.setFirstResult(firstResult);
            }
            return q.getResultList();
        } finally {
            em.close();
        }
    }

    public User findUser(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(User.class, id);
        } finally {
            em.close();
        }
    }

    public int getUserCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<User> rt = cq.from(User.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
