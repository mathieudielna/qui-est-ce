/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import controller.exceptions.IllegalOrphanException;
import controller.exceptions.NonexistentEntityException;
import entity.Logement;
import java.io.Serializable;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;
import entity.Maison;
import entity.Type;
import entity.User;
import entity.Ville;
import java.util.ArrayList;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;

/**
 *
 * @author mathieudielna
 */
public class LogementJpaController implements Serializable {

    public LogementJpaController(EntityManagerFactory emf) {
        this.emf = emf;
    }
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Logement logement) {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Maison maison = logement.getMaison();
            if (maison != null) {
                maison = em.getReference(maison.getClass(), maison.getIdLogement());
                logement.setMaison(maison);
            }
            Type idType = logement.getIdType();
            if (idType != null) {
                idType = em.getReference(idType.getClass(), idType.getIdType());
                logement.setIdType(idType);
            }
            User idUser = logement.getIdUser();
            if (idUser != null) {
                idUser = em.getReference(idUser.getClass(), idUser.getIdUser());
                logement.setIdUser(idUser);
            }
            Ville idVille = logement.getIdVille();
            if (idVille != null) {
                idVille = em.getReference(idVille.getClass(), idVille.getIdVille());
                logement.setIdVille(idVille);
            }
            em.persist(logement);
            if (maison != null) {
                Logement oldLogementOfMaison = maison.getLogement();
                if (oldLogementOfMaison != null) {
                    oldLogementOfMaison.setMaison(null);
                    oldLogementOfMaison = em.merge(oldLogementOfMaison);
                }
                maison.setLogement(logement);
                maison = em.merge(maison);
            }
            if (idType != null) {
                idType.getLogementCollection().add(logement);
                idType = em.merge(idType);
            }
            if (idUser != null) {
                idUser.getLogementCollection().add(logement);
                idUser = em.merge(idUser);
            }
            if (idVille != null) {
                idVille.getLogementCollection().add(logement);
                idVille = em.merge(idVille);
            }
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(Logement logement) throws IllegalOrphanException, NonexistentEntityException, Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Logement persistentLogement = em.find(Logement.class, logement.getIdLogement());
            Maison maisonOld = persistentLogement.getMaison();
            Maison maisonNew = logement.getMaison();
            Type idTypeOld = persistentLogement.getIdType();
            Type idTypeNew = logement.getIdType();
            User idUserOld = persistentLogement.getIdUser();
            User idUserNew = logement.getIdUser();
            Ville idVilleOld = persistentLogement.getIdVille();
            Ville idVilleNew = logement.getIdVille();
            List<String> illegalOrphanMessages = null;
            if (maisonOld != null && !maisonOld.equals(maisonNew)) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("You must retain Maison " + maisonOld + " since its logement field is not nullable.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            if (maisonNew != null) {
                maisonNew = em.getReference(maisonNew.getClass(), maisonNew.getIdLogement());
                logement.setMaison(maisonNew);
            }
            if (idTypeNew != null) {
                idTypeNew = em.getReference(idTypeNew.getClass(), idTypeNew.getIdType());
                logement.setIdType(idTypeNew);
            }
            if (idUserNew != null) {
                idUserNew = em.getReference(idUserNew.getClass(), idUserNew.getIdUser());
                logement.setIdUser(idUserNew);
            }
            if (idVilleNew != null) {
                idVilleNew = em.getReference(idVilleNew.getClass(), idVilleNew.getIdVille());
                logement.setIdVille(idVilleNew);
            }
            logement = em.merge(logement);
            if (maisonNew != null && !maisonNew.equals(maisonOld)) {
                Logement oldLogementOfMaison = maisonNew.getLogement();
                if (oldLogementOfMaison != null) {
                    oldLogementOfMaison.setMaison(null);
                    oldLogementOfMaison = em.merge(oldLogementOfMaison);
                }
                maisonNew.setLogement(logement);
                maisonNew = em.merge(maisonNew);
            }
            if (idTypeOld != null && !idTypeOld.equals(idTypeNew)) {
                idTypeOld.getLogementCollection().remove(logement);
                idTypeOld = em.merge(idTypeOld);
            }
            if (idTypeNew != null && !idTypeNew.equals(idTypeOld)) {
                idTypeNew.getLogementCollection().add(logement);
                idTypeNew = em.merge(idTypeNew);
            }
            if (idUserOld != null && !idUserOld.equals(idUserNew)) {
                idUserOld.getLogementCollection().remove(logement);
                idUserOld = em.merge(idUserOld);
            }
            if (idUserNew != null && !idUserNew.equals(idUserOld)) {
                idUserNew.getLogementCollection().add(logement);
                idUserNew = em.merge(idUserNew);
            }
            if (idVilleOld != null && !idVilleOld.equals(idVilleNew)) {
                idVilleOld.getLogementCollection().remove(logement);
                idVilleOld = em.merge(idVilleOld);
            }
            if (idVilleNew != null && !idVilleNew.equals(idVilleOld)) {
                idVilleNew.getLogementCollection().add(logement);
                idVilleNew = em.merge(idVilleNew);
            }
            em.getTransaction().commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                Integer id = logement.getIdLogement();
                if (findLogement(id) == null) {
                    throw new NonexistentEntityException("The logement with id " + id + " no longer exists.");
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
            Logement logement;
            try {
                logement = em.getReference(Logement.class, id);
                logement.getIdLogement();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The logement with id " + id + " no longer exists.", enfe);
            }
            List<String> illegalOrphanMessages = null;
            Maison maisonOrphanCheck = logement.getMaison();
            if (maisonOrphanCheck != null) {
                if (illegalOrphanMessages == null) {
                    illegalOrphanMessages = new ArrayList<String>();
                }
                illegalOrphanMessages.add("This Logement (" + logement + ") cannot be destroyed since the Maison " + maisonOrphanCheck + " in its maison field has a non-nullable logement field.");
            }
            if (illegalOrphanMessages != null) {
                throw new IllegalOrphanException(illegalOrphanMessages);
            }
            Type idType = logement.getIdType();
            if (idType != null) {
                idType.getLogementCollection().remove(logement);
                idType = em.merge(idType);
            }
            User idUser = logement.getIdUser();
            if (idUser != null) {
                idUser.getLogementCollection().remove(logement);
                idUser = em.merge(idUser);
            }
            Ville idVille = logement.getIdVille();
            if (idVille != null) {
                idVille.getLogementCollection().remove(logement);
                idVille = em.merge(idVille);
            }
            em.remove(logement);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public List<Logement> findLogementEntities() {
        return findLogementEntities(true, -1, -1);
    }

    public List<Logement> findLogementEntities(int maxResults, int firstResult) {
        return findLogementEntities(false, maxResults, firstResult);
    }

    private List<Logement> findLogementEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Logement.class));
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

    public Logement findLogement(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Logement.class, id);
        } finally {
            em.close();
        }
    }

    public int getLogementCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Logement> rt = cq.from(Logement.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
