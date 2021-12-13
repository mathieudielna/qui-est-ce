/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package controller;

import controller.exceptions.NonexistentEntityException;
import controller.exceptions.PreexistingEntityException;
import entity.Appartement;
import java.io.Serializable;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.EntityManagerFactory;
import javax.persistence.Query;
import javax.persistence.EntityNotFoundException;
import javax.persistence.criteria.CriteriaQuery;
import javax.persistence.criteria.Root;

/**
 *
 * @author mathieudielna
 */
public class AppartementJpaController implements Serializable {

    public AppartementJpaController(EntityManagerFactory emf) {
        this.emf = emf;
    }
    private EntityManagerFactory emf = null;

    public EntityManager getEntityManager() {
        return emf.createEntityManager();
    }

    public void create(Appartement appartement) throws PreexistingEntityException, Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            em.persist(appartement);
            em.getTransaction().commit();
        } catch (Exception ex) {
            if (findAppartement(appartement.getIdLogement()) != null) {
                throw new PreexistingEntityException("Appartement " + appartement + " already exists.", ex);
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void edit(Appartement appartement) throws NonexistentEntityException, Exception {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            appartement = em.merge(appartement);
            em.getTransaction().commit();
        } catch (Exception ex) {
            String msg = ex.getLocalizedMessage();
            if (msg == null || msg.length() == 0) {
                Integer id = appartement.getIdLogement();
                if (findAppartement(id) == null) {
                    throw new NonexistentEntityException("The appartement with id " + id + " no longer exists.");
                }
            }
            throw ex;
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public void destroy(Integer id) throws NonexistentEntityException {
        EntityManager em = null;
        try {
            em = getEntityManager();
            em.getTransaction().begin();
            Appartement appartement;
            try {
                appartement = em.getReference(Appartement.class, id);
                appartement.getIdLogement();
            } catch (EntityNotFoundException enfe) {
                throw new NonexistentEntityException("The appartement with id " + id + " no longer exists.", enfe);
            }
            em.remove(appartement);
            em.getTransaction().commit();
        } finally {
            if (em != null) {
                em.close();
            }
        }
    }

    public List<Appartement> findAppartementEntities() {
        return findAppartementEntities(true, -1, -1);
    }

    public List<Appartement> findAppartementEntities(int maxResults, int firstResult) {
        return findAppartementEntities(false, maxResults, firstResult);
    }

    private List<Appartement> findAppartementEntities(boolean all, int maxResults, int firstResult) {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            cq.select(cq.from(Appartement.class));
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

    public Appartement findAppartement(Integer id) {
        EntityManager em = getEntityManager();
        try {
            return em.find(Appartement.class, id);
        } finally {
            em.close();
        }
    }

    public int getAppartementCount() {
        EntityManager em = getEntityManager();
        try {
            CriteriaQuery cq = em.getCriteriaBuilder().createQuery();
            Root<Appartement> rt = cq.from(Appartement.class);
            cq.select(em.getCriteriaBuilder().count(rt));
            Query q = em.createQuery(cq);
            return ((Long) q.getSingleResult()).intValue();
        } finally {
            em.close();
        }
    }
    
}
